<?php
$bgcolor_top = "#050D24";
$text_top = "#CCCCCC";

$bgcolor_head = "#0B1D51";
$text_head = "#EBB97C";
$headline_head = "#ffffff";

$bgcolor_main = "#EDF2F4";
$text_main = "#393B47";
$headline_main = "#291400";


$bgcolor_footer = "#333333";
$text_footer = "#FFFFFF";

$primary = "#FF8811";
$secondary = "#2589BD";

$border_highlight = "#FFE1BD";
$bgcolor_highlight = "#FFFFFF";

$bgcolor_count = "#DEE5EC";
?>
@import url('https://fonts.googleapis.com/css?family=Playfair+Display|Raleway|Quicksand');
/*colour scheme: https://www.colourlovers.com/palette/2557991/Charcoal_and_Crayon*/
body {
	font-family: "Quicksand", "Open sans", Arial;
	font-size: 1.0em;
	line-height: 1.3em
}

h1, h2, h3, h4, h5, h6 {
	font-family: "Playfair Display";
	color:<?php echo $headline_head?>;
}
h1 {
	font-size:1.8em;
}
h2 {
	font-size:1.5em;
}
h3 {
	font-family: "Quicksand", "Open sans", Arial;	
	font-weight: 900;
	font-size:1.1em;
}
h4 {
	font-family: "Quicksand", "Open sans", Arial;
	font-weight: 900;	
	font-size:1em;
}
a {
	 color:#393B47;
}
small {
	font-size: 90%;
}
.page_head {
	 background-color:<?php echo $bgcolor_head ?>;
	 color:<?php echo $text_head ?>;
	 padding-top:20px;
	 padding-bottom:20px;
}
.page_head a{
	 color:<?php echo $text_head ?>;
}
.page_head h1,.page_head h2{
	 color:<?php echo $headline_head ?>;
}
.page_body {
	 background-color:<?php echo $bgcolor_main ?>;
	 color:<?php echo $text_main ?>;
	 padding-top:20px;
	 min-height: 60%;	 
}
.page_body h1, .page_body h2, .page_body h3, .page_body h4, .page_body h5{
	 color:<?php echo $headline_main?>;
}
.page_body a{
	 color: <?php echo $text_main ?>;
}
.page_footer {
	background-color:<?php echo $bgcolor_footer ?>;
	color:<?php echo $text_footer ?>;
	min-height: 200px;
	padding-top:20px;
}
.tagline {
	background-color: #222222;
	color:#ffffff;
	font-size: 0.8em;
	text-transform: uppercase;
	padding:6px;
}
a.product-link {
	color: #CB8026;
	font-weight: 800;
}
.list_title {
	font-size: 1.2em;
	height:60px;
}
.menu, .menu .nav {
	background-color: <?php echo $bgcolor_head ?>;
	color:<?php echo $text_head ?>;
	padding-top:0.5em;
}
.menu .navbar {
	padding-left: 0px;
	padding-right: 0px;
}
.navbar-dark .navbar-nav .nav-link {
    color: #FFE1BD;
}
.metalprice {
	text-align:center;
	font-size:0.9em;
	padding:8px;
	padding-left:15px;
	padding-right:15px;
	background-color: <?php echo $bgcolor_top?>;
	color: <?php echo $text_top; ?>;
}
.category_item {
	background-color: <?php echo $bgcolor_highlight?>;
	border:1px solid <?php echo $border_highlight?>;
	padding:10px;	
}
.category_item { img
	max-height: 250px;
}
.category_box {
	background-color: <?php echo $bgcolor_highlight?>;
	border:1px solid <?php echo $border_highlight?>;
	padding:10px;
	margin-bottom:10px;	
}
.category_box a {
	 color: <?php echo $primary ?>;
}
.row .column_headline {
	font-weight: 800;
	text-align:left;
	margin-left: 0px;
	margin-right: 0px;
	padding-bottom:6px;
	margin-bottom:6px;
}
.row .productrow {
	text-align:left;
	padding-bottom:6px;
	padding-top:6px;
	border-bottom: 1px solid #eeeeee;
}
.row .productrow div{
	background-color: #ffffff;
}

.striped:nth-child(even) {
	background-color: #f2f2f2;
}
.price {
	font-size: 1.1em;
	font-weight: 700;
	line-height: 1.2em;	
	color: #FF6961;
	white-space: nowrap;
}
/*.category_item  .price:first-child {
	font-size: 1.4em;
}*/
.offer {
	font-size: 0.9em;
	padding:6px;
	background-color:<?php echo $secondary?>;
	color:#ffffff !important;
	border:0px;
	white-space: nowrap;
}
.margin-adjust-6 {
	margin-top: -6px;
}

.shop_usp {
	font-size:0.8em;
	color:#FFFFFF;
}
.stockout {
	color: #FF595E;
}
.stockin {
	color: #88A226;
}
/* A filter group folds away from its heading. Built on <details>, so it works
   without script; the summary is styled to match the h4 the shorter groups use. */
.filter-group summary {
	font-family: "Quicksand", "Open sans", Arial;
	font-weight: 900;
	font-size: 1em;
	color: <?php echo $headline_main?>;
	cursor: pointer;
	display: flex;
	align-items: center;
	justify-content: space-between;
	list-style: none;
	margin-bottom: 8px;
}
.filter-group summary::-webkit-details-marker {
	display: none;
}
.filter-group summary::after {
	content: "";
	flex: none;
	width: 7px;
	height: 7px;
	margin-left: 8px;
	border-right: 2px solid currentColor;
	border-bottom: 2px solid currentColor;
	transform: rotate(45deg) translate(-2px, -2px);
	transition: transform 0.15s ease;
}
.filter-group[open] summary::after {
	transform: rotate(-135deg);
}
/* Result counts next to a filter option or a product group link. */
.filter-count {
	display: inline-block;
	min-width: 2.1em;
	padding: 1px 6px;
	margin-left: 5px;
	border-radius: 4px;
	background-color: <?php echo $bgcolor_count?>;
	color: <?php echo $text_main?>;
	font-size: 0.75em;
	font-weight: 600;
	line-height: 1.6;
	text-align: center;
	vertical-align: middle;
}
/* A ticked option carries the head colours so the active filters read at a glance. */
.form-check-input:checked ~ .form-check-label .filter-count {
	background-color: <?php echo $bgcolor_head?>;
	color: <?php echo $text_head?>;
}
ul.shortcuts {
	font-size: 0.9em;
	list-style-type: none;
	padding:0px;
}
ul.shortcuts li {
	padding-bottom:6px;
	padding-left:0px;				
}
#more {
	display: none;
}
#searchBox a {
	color: #EBB97C;
}

p.intro {
	font-size: 1.1em;
	line-height: 1.4em;
	color:#eeeeee;
}
p.chart-title {
	color:#eeeeee;
	font-size: 0.9em;
	text-transform: uppercase;
}

/*custom bootstrap */
.btn, .form-control, .dropdown-menu {
	border-radius: 0;
}
input, select {
	border-radius: 0;
}
.btn-dark {
	background-color:#393B47;
}
.btn-info, .btn-info:hover, .btn-info:visited {
	background-color:<?php echo $secondary?>;
	color:#ffffff !important;
	border:0px;	
}
.btn-outline-secondary,.btn-outline-secondary:hover, .btn-outline-secondary:visited  {
	background-color:#ffffff;
	border-color:<?php echo $secondary?>;
	color: #333333;
}
.btn-cta {
	margin-top:6px;
} 

.dropdown-menu {
	font-size: 1.1rem;
}

.footer-flag {
	width:30px;
}
.blog_post_grid {
	background-color: <?php echo $bgcolor_highlight?>;
	border:1px solid <?php echo $border_highlight?>;
	padding:10px;
	margin-bottom:20px;
	min-height:250px;
}
.blog_post_list ul {
	background-color:#ffffff;
	line-height: 1.3em;
	padding:20px
}
.blog_post_list li {
	margin-bottom:10px;
	list-style: none;
}
.blog_post_list a {
	 color: <?php echo $primary ?>;
}
/*Text spinner*/

.spinny-wrapper{
	margin-top: 20px;
	display: flex;
	align-items: center;
	justify-content: flex-start;
	position: relative;

}

.spinny-words{
    display: inline-block;
    min-width: 200px;
    text-align: left;
}
.spinny-words span{
    position: absolute;
    font-weight: bold;
    top:-0px;
    opacity: 0;    
    animation: rotateWord 18s linear infinite 0s;
}
.spinny-words span:nth-child(2) { 
    animation-delay: 3s; 
}
.spinny-words span:nth-child(3) { 
    animation-delay: 6s; 
}
.spinny-words span:nth-child(4) { 
    animation-delay: 9s; 
}
.spinny-words span:nth-child(5) { 
    animation-delay: 12s; 
}
.spinny-words span:nth-child(6) { 
    animation-delay: 15s; 
}
@keyframes rotateWord {
  0%   { opacity: 0; }
  2%   { opacity: 0; transform: translateY(-30px); }
  5%   { opacity: 1; transform: translateY(0px);}
  17%  { opacity: 1; transform: translateY(0px); }
  20%  { opacity: 0; transform: translateY(30px); }
  80%  { opacity: 0; }
  100% { opacity: 0; }
}

.fixed-top {
	background-color:<?php echo $bgcolor_head ?>;
}
.sticky-footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   z-index:1000;	
}

@media (max-width: 1024px) {
	body {
		font-size: 0.9em;
		line-height: 1.2em;
	}
	.nav-link {
		font-size: 1.3em;
		line-height: 1.5em;
	}
	.dropdown-item  {
		font-size: 1.2em;
		line-height: 1.8em;
	}
	h1 {
		font-size:1.5em;
	}
	h2 {
		font-size:1.3em;
	}
	h3 {
		font-size:1.2em;
	}
	h4 {
		font-size:1em;
	}
	.price {
	font-size: 1.2em;
	line-height: 1.1em;	
	white-space: normal;
	}
}
@media (min-width:1456px) { 
	.container{max-width:1440px}
}

