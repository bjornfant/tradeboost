<?php
class db {

    /**
     * One mysqli connection is shared for the whole request.
     * The models create "new db" in nearly every method, and get_product() runs
     * inside loops, so a connection per instance meant dozens of handshakes to a
     * remote MySQL host on a single page view.
     */
    protected static $shared_connection = null;

    protected $connection;
    protected $show_errors = TRUE;
    public $query_count = 0;
    public $affected_rows = 0;
    public $insert_id = 0;

    public function __construct($dbhost = DB_HOST, $dbuser = DB_USER, $dbpass = DB_PASSWORD, $dbname = DB_NAME, $charset = DB_CHARSET) {

        if (self::$shared_connection instanceof mysqli) {
            $this->connection = self::$shared_connection;
            return;
        }

        // Set the reporting mode explicitly so behaviour is the same on PHP 7 and 8.
        // PHP 8.1 turned exceptions on by default, which silently changed how
        // connection and query failures surface.
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            $connection->set_charset($charset);
        } catch (mysqli_sql_exception $exception) {
            $this->error('Database connection failed', $exception->getMessage());
        }

        self::$shared_connection = $connection;
        $this->connection = $connection;
    }

    /**
     * Run a SELECT and return the result set.
     *
     * Values must never be concatenated into $sql. Put a ? placeholder in the
     * statement and pass the value in $parameters instead:
     *
     *     $db->query_select("SELECT * FROM pricecomp_product WHERE product_id = ?", [$product_id]);
     *
     * Returns an object with ->num_rows, ->row (first row) and ->rows,
     * or TRUE for statements that produce no result set.
     */
    public function query_select($sql, $parameters = array()) {
        return $this->run($sql, $parameters);
    }

    /**
     * Run an INSERT / UPDATE / REPLACE / DELETE. Same placeholder rules as above.
     * Check ->affected_rows and ->insert_id afterwards if you need them.
     */
    public function query($sql, $parameters = array()) {
        return $this->run($sql, $parameters);
    }

    private function run($sql, $parameters) {

        $statement = null;

        try {
            $statement = $this->connection->prepare($sql);

            if ($statement === false) {
                $this->error('Unable to prepare statement', $this->connection->error . ' - ' . $sql);
            }

            $values = array_values($parameters);

            if (!empty($values)) {
                $statement->bind_param($this->parameter_types($values), ...$values);
            }

            $statement->execute();

            $this->query_count++;

            $result = $statement->get_result();

            if ($result instanceof mysqli_result) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                $output = new \stdClass();
                $output->num_rows = count($rows);
                $output->row = isset($rows[0]) ? $rows[0] : array();
                $output->rows = $rows;

                $result->free();
                $statement->close();

                return $output;
            }

            // get_result() returns false both for statements without a result set
            // and when mysqlnd is missing. field_count tells the two apart.
            if ($statement->field_count > 0) {
                $this->error('Unable to read result set', 'get_result() failed, mysqlnd may be unavailable - ' . $sql);
            }

            $this->affected_rows = $statement->affected_rows;
            $this->insert_id = $this->connection->insert_id;

            $statement->close();

            return true;

        } catch (mysqli_sql_exception $exception) {

            if ($statement instanceof mysqli_stmt) {
                @$statement->close();
            }

            $this->error('Query failed', $exception->getMessage() . ' - ' . $sql);
        }
    }

    /**
     * mysqli needs a type character per bound value.
     */
    private function parameter_types($values) {
        $types = '';

        foreach ($values as $value) {
            $types .= $this->_gettype($value);
        }

        return $types;
    }

    public function close() {
        if (self::$shared_connection instanceof mysqli) {
            self::$shared_connection->close();
            self::$shared_connection = null;
        }

        $this->connection = null;

        return true;
    }

    public function lastInsertID() {
        return $this->insert_id;
    }

    public function affectedRows() {
        return $this->affected_rows;
    }

    /**
     * The detail goes to the error log, never to the visitor: it contains the
     * statement and can contain fragments of data.
     */
    public function error($message, $detail = '') {
        error_log('DB error: ' . $message . ' - ' . $detail);

        if ($this->show_errors) {
            throw new \Exception('Error: ' . $message);
        }

        return false;
    }

    private function _gettype($var) {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        if (is_null($var)) return 's';
        return 'b';
    }

}
