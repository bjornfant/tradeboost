<?php
require __DIR__ . '/../model/catalog.php';
require __DIR__ . '/../model/commodity.php';
require __DIR__ . '/../model/ads.php';
require __DIR__ . '/../translation/translations.php';
require __DIR__ . '/../translation/translations_product_list.php';
require __DIR__ . '/../model/statistics.php';
require_once __DIR__ . '/inc_filter.php';
$page_view = new Statistic;
$page_view->track_pageview(HTTP);

$page_language = COUNTRY_DEFAULT;
$page_currency  = CURRENCY_DEFAULT;

$price_array = new Commodity;
$comodity_price_array = array();
$comodity_price_array['AU'] = $price_array->get_commodity_price('AU');
$comodity_price_array['SI'] = $price_array->get_commodity_price('SI');

$ad_inventory['left'] = gererate_adsense_html(HTTP, 'left');		
$ad_inventory['middle'] = gererate_adsense_html(HTTP, 'middle');	

$catalog = new Catalog;
$db = new db;
$filter = false;
$sort = "";
$category_params = array();


if($product_type) {
	$category_params[] = array('sql' => "p.type = ?", 'params' => array($product_type));
}

$countries_array = $catalog->get_countries($category_params);
$manufacturers_array = $catalog->get_manufacturers();
$sorting_array = $translation[$page_language]['sorting'];


$selected_facets = tradeboost_selected_facets();

//Don't list bundle items
$category_params[] = "pb.quantity IS NULL";

//only with more than 2 offers";
$category_params[] = "(SELECT count(id) FROM pricecomp_store_product_to_product sp2p WHERE product_id = p.product_id) > 2";

//only with an updated price
$category_params[] = "(p.lowest_price_eur/p.metal_weight_oz) > 0";

//only cheap products
$category_params[] = "p.lowest_price_eur < 150";

if(!isset($sort_params)) { $sort_params = array(); }


$sort_key = tradeboost_sort_key();
$sort_orders = tradeboost_sort_orders();
$sort = $sort_orders[$sort_key];

$price_min = tradeboost_price_bound('price_min');
$price_max = tradeboost_price_bound('price_max');

$currency_rates = $catalog->get_currency_rates();
$price_min_eur = tradeboost_price_to_eur($catalog, $page_currency, $price_min, $currency_rates);
$price_max_eur = tradeboost_price_to_eur($catalog, $page_currency, $price_max, $currency_rates);

$spot_prices_eur = array(
	'AU' => $comodity_price_array['AU']['EUR']['price_per_oz'],
	'SI' => $comodity_price_array['SI']['EUR']['price_per_oz'],
);

// Facets are counted from the base constraints, the same ones the product
// query uses, so the numbers always add up to what the list contains.
$base_params = $category_params;

$price_filter = $catalog->filter_price($price_min_eur, $price_max_eur);
if($price_filter) { $base_params['price'] = $price_filter; }

$manufacturer_filter = $catalog->filter_in('p.manufacturer', $selected_facets['manufacturer']);
if($manufacturer_filter) { $base_params['manufacturer'] = $manufacturer_filter; }

$facet_counts = $catalog->count_facets($catalog->get_facet_rows($base_params), $selected_facets, $spot_prices_eur);

$category_params = $base_params;

$country_filter = $catalog->filter_in('p.country_origin', $selected_facets['country']);
if($country_filter) { $category_params['country'] = $country_filter; }

$weight_filter = $catalog->filter_weight($selected_facets['weight']);
if($weight_filter) { $category_params['weight'] = $weight_filter; }

$premium_filter = $catalog->filter_premium($selected_facets['premium'], $spot_prices_eur);
if($premium_filter) { $category_params['premium'] = $premium_filter; }

$products_total = $catalog->get_products($category_params, false, $sort,false, false, true);
$limit = 30;
$page = 1;
if(!empty($_GET['page'])) {
	$page = $_GET['page'];
}
$products_array = $catalog->get_products($category_params, false, $sort, $limit, $page);

//filter and sort
$filtered_products = array();
if(!empty($products_array)) {
	foreach($products_array as $product) {
		$show_product = true;
		if(!isset($product['store_products'])) { $show_product = false;} //only show products that are for sale somewhere
		//if(!empty($_GET['metal_weight_class']) && $_GET['metal_weight_class'] != $product['metal_weight_class']) { $show_product = false; }

		if($show_product) {

			$first_store_product = reset($product['store_products']);
			$product['offers'] = (int) count($product['store_products']);
			
			if(isset($_GET['stock_only'])) {
				if($_GET['stock_only'] == 1) {
					$first_store_product = reset($product['store_products_in_stock']);
					$product['offers'] = (int) count($product['store_products_in_stock']);
				}
			} 

			$product['best_price'] = $first_store_product['price'];
			$product['best_price_per_oz'] = $first_store_product['price_per_oz'];
			$product['best_price_compare_to_spot'] = 100*((float) $product['best_price_per_oz'] - (float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'])/(float) $comodity_price_array[$product['metal']][$page_currency]['price_per_oz'];

			$product['metal_type'] = strtolower($translation['EN'][$product['metal']].$product['type']);

			if($first_store_product['price'] > 0) {
				$filtered_products[] = $product; 
			}
			
		}
		
	}	
}

$sort = false;

if(!empty($_GET['sort'])) {
	$sort = $_GET['sort'];	
}

$filter_groups = tradeboost_filter_groups($catalog, $facet_counts, $selected_facets, $countries_array, $translation, $page_language);
$price_filter_labels = tradeboost_price_labels($translation, $page_language);
$sort_options = tradeboost_sort_options($sorting_array, $sort_key);

$selected = "";
if(!empty($_GET['stock_only']) && $_GET['stock_only'] == 1) { $selected = "checked"; }
$stock_only = "<input class='form-check-input' type='checkbox' value='1' id='stock_only' name='stock_only' " . $selected . " >";




$og_tags = array();

switch ($page_language) {
	case "SE":
		$page_meta_title = "Presenter och gåvor av guld och silver";
		$page_meta_description = "Här är några perfekta presenter för högtider, födelsedagar eller speciella tillfällen. Guld kallas ofta för solens symbol med sin gula färg och vackra glans. Metallen representerar vanligtvis styrka eller rikedom och på många platser en gåva som önskar lycka och välstånd. Guld används också för att dekorera föremål och byggnader i nästan alla kulturer och är naturligt kopplad till fester, festivaler och speciella tillfällen. Även ett enkelt 1 grams mynt eller en guldtacka på 1-2 gram har kraften att trollbinda personen som tar emot det.
		<br><br>
Silver är en bra present att ge någon på födelsedagar, dop eller bröllop. Det är en symbol för skydd och säkerhet samt en vacker värdefull gåva. I vissa äldre kulturer sägs silver förstöra ondskan. Det är ett vapen eller en amulett som ska användas mot varulvar, häxor och monster. Ordet <i>silver bullet</i> finns kvar idag och betyder <i>den perfekta lösningen som löser alla problem</i>. Silver har vuxit till att bli ett populärt val bland investerare och det finns får saker  som slår ett glänsande silvermynt för att få en ung investerare intresserad av värdefulla metaller.";
		break;
	case "DE":
		$page_meta_title = "Geschenkideen und Präsente in Gold und Silber";
		$page_meta_description = "Hier sind einige tolle Geschenke für Feiertage, Geburtstage oder besondere Anlässe. Gold hat einen einzigartigen Glanz und eine gelbe Farbe und wird oft als Symbol der Sonne bezeichnet. Es steht normalerweise für Stärke, Reichtum und Reinheit und ist vielerorts ein Geschenk, das Glück und Wohlstand wünscht. Gold wird auch in fast allen Kulturen zur Dekoration von Gegenständen und Gebäuden verwendet und ist natürlich mit Feiern, Festen und besonderen Anlässen verbunden. Selbst ein kleines Stück Gold wie eine 1-Gramm-Münze hat die Kraft, die Person zu beeindrucken, die es erhält.
<br><br>
Silber ist ein tolles Geschenk für Geburtstage, Taufen oder Hochzeiten. Es ist ein Symbol für Schutz und Geborgenheit sowie ein wunderschönes, kostbares Geschenk. In einigen älteren Kulturen wird Silber als Vernichtung des Bösen bezeichnet. Es ist eine Waffe oder ein Amulett, das gegen Werwölfe, Hexen und Monster eingesetzt wird. Das Wort <i>Silver bullet</i> gibt es noch heute und bedeutet <i>die perfekte Lösung, die alle Probleme löst</i>. Silber ist bei Anlegern zu einer beliebten Wahl geworden, und es gibt nichts Schöneres als eine glänzende Silbermünze, um einen jungen Anleger für Edelmetalle zu interessieren.";
		break;
	case "FR":
		$page_meta_title = "Idées cadeaux et cadeaux en or et argent";
		$page_meta_description = "Voici de superbes cadeaux pour les vacances, les anniversaires ou les occasions spéciales. L'or a une lueur unique et une couleur jaune et est souvent considéré comme le symbole du soleil. Il représente généralement la force, la richesse et la pureté et, dans de nombreux endroits, un cadeau qui souhaite bonne fortune et prospérité. L'or est également utilisé pour décorer des objets et des bâtiments dans presque toutes les cultures et est naturellement lié aux célébrations, aux festivals et aux occasions spéciales. Même une petite pièce d'or comme une pièce de 1 gramme a le pouvoir d'impressionner la personne qui la reçoit.
<br><br>
L'argent est un excellent cadeau à offrir à quelqu'un pour un anniversaire, un baptême ou un mariage. C'est un symbole de protection et de sécurité ainsi qu'un beau cadeau précieux. Dans certaines cultures plus anciennes, on dit que l'argent est la destruction du mal. C'est une arme ou une amulette à utiliser contre les loups-garous, les sorcières et les monstres. Le mot <i>silver bullet</i> est toujours d'actualité et signifie <i>la solution parfaite qui résout tous les problèmes</i>. L'argent est devenu un choix populaire parmi les investisseurs et rien de tel qu'une pièce d'argent brillante pour intéresser un jeune investisseur aux métaux précieux.";
		break;
	case "NL":
		$page_meta_title = "Cadeau-ideeën en cadeaus in goud en zilver";
		$page_meta_description = "Hier zijn enkele geweldige cadeaus voor vakanties, verjaardagen of speciale gelegenheden. Goud heeft een unieke gloed en gele kleur en wordt vaak het symbool van de zon genoemd. Het vertegenwoordigt gewoonlijk kracht, rijkdom en zuiverheid en op veel plaatsen een geschenk dat geluk en voorspoed wenst. Goud wordt ook gebruikt voor het decoreren van voorwerpen en gebouwen in bijna alle culturen en is natuurlijk gekoppeld aan feesten, festivals en speciale gelegenheden. Zelfs een klein stukje goud, zoals een munt van 1 gram, heeft de kracht om indruk te maken op de persoon die het ontvangt.
<br><br>
Zilver is een geweldig cadeau om iemand te geven voor verjaardagen, doopfeesten of bruiloften. Het is een symbool van bescherming en veiligheid, evenals een mooi kostbaar geschenk. In sommige oudere culturen wordt van zilver gezegd dat het de vernietiging van het kwaad is. Het is een wapen of amulet om te gebruiken tegen weerwolven, heksen en monsters. Het woord <i>silver bullet</i> bestaat nog steeds en betekent <i>de perfecte oplossing die alle problemen oplost</i>. Zilver groeide uit tot een populaire keuze onder beleggers en er gaat niets boven een glanzende zilveren munt om een ​​jonge belegger geïnteresseerd te krijgen in edele metalen.";
		break;
	case "ES":
		$page_meta_title = "Ideas de regalos y regalos en oro y plata";
		$page_meta_description = "Aquí hay algunos grandes regalos para vacaciones, cumpleaños u ocasiones especiales. El oro tiene un brillo único y un color amarillo y, a menudo, se lo conoce como el símbolo del sol. Usualmente representa fuerza, riqueza y pureza y en muchos lugares un regalo que desea buena fortuna y prosperidad. El oro también se usa para decorar artículos y edificios en casi todas las culturas y, naturalmente, está relacionado con celebraciones, festivales y ocasiones especiales. Incluso una pequeña pieza de oro como una moneda de 1 gramo tiene el poder de impresionar a la persona que la recibe.
<br><br>
La plata es un gran regalo para regalar a alguien en cumpleaños, bautizos o bodas. Es un símbolo de protección y seguridad, así como un hermoso regalo precioso. En algunas culturas más antiguas, se dice que la plata es la destrucción del mal. Es un arma o amuleto para ser usado contra hombres lobo, brujas y monstruos. La palabra <i>silver bullet</i> todavía existe hoy y significa <i>la solución perfecta que resuelve todos los problemas</i>. La plata creció hasta convertirse en una opción popular entre los inversionistas y no hay nada como una moneda de plata brillante para que un joven inversionista se interese en los metales preciosos.";
		break;
	default:
		$page_meta_title = "Gift ideas and presents in gold and silver";
		$page_meta_description = "Here are some great gifts for holidays, birthdays or special occasions. Gold has a unique glow and yellow shine and is often refered to as the symbol of the sun. It ususally represents strength, wealth and purity and in many places a gift that wishes good fortune and prosperity. Gold is also used for decorating items and buildings in almost all cultures and is naturally linked to celebration, festivals and special occasions. Even a small piece of gold like 1 gram coin or ingot has the power to mezmerize the person who receives it. 
<br><br>
Silver is a great present to give someone for birthdays, baptism or weddings. It's a symbol of protection and security as well as a beutiful precious gift. In some older cultures, silver is said to be the destruction of evil. It's a weapon or amulett to be used against werewolves, witches and monsters. The word <i>silver bullet</i> is still around today and means <i>the perfect solution that solves all problems</i>. Silver grown to become a popular choice among investors and there is nothing like a shiny silver coin to get a young investor interested in prescious metals. ";
}

// After the switch above has built the title, not before it.
tradeboost_paginate_meta($page_meta_title, $page_meta_description, $page, $translation, $page_language);

$og_tags[] = array('property' => 'og:title', 'content' => $page_meta_title);
$og_tags[] = array('property' => 'og:description', 'content' => $page_meta_description);	

//page title and description
$page_title = $page_meta_title; 
$page_description = $page_meta_description;


$pagination = $catalog->pagination($products_total, $limit, $page, $_SERVER['REQUEST_URI']);

$view_name = "product_list";
require_once(BASE_DIR . '/view/base.view.php');

?>