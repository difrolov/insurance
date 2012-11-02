<?	//$url=$_GET['base_url'];?>
<style>
@charset "utf-8";
/* CSS Document */

div#article_preview_text{
	display:<?="none"?>;
	max-height:35%;
	padding-right:24px;
	position:fixed;
	z-index:2;
}
div#article_preview_text div#wrp{
	border:solid 1px #FFCC00;
	box-shadow: 0 0 20px 0 #666;
}
div#article_preview_text
	div#prev_content{
	background:#FFF;
	max-height:330px;
	overflow:auto;
	padding:8px;
	text-align:left;
}
div.modal-header{
	border-bottom:none;
}
div#prev_header{
	background: lightYellow;
	border-bottom:solid 2px #FC0;
	font-weight:700;
	padding: 8px;
	text-align:left;
}
div#upload_article_window{
	background:#FFF; 
	border:solid 2px #CCC; 
	box-shadow: 0 0 30px 0 #666;
	padding:4px; 
	position:absolute; 
	z-index:3000; 
	display:<?="none"?>; 
}
table#new_art_header{
	width:98%;
	margin: -15px auto -2px auto;
}
table#new_art_header input[type="text"]{
	padding:2px 4px;
	width:100%;
}
table#new_art_header td{
	padding:0;
}
table#new_art_header tr td:first-child{
	padding-right:4px;
}
table#tblArticles {
	border:solid 1px #CCC;
}
table#tblArticles tr td{
	border-bottom:dashed 1px #CCC;
}
table#tblArticles tbody tr:first-child td{
	border-bottom-style:solid;
}
table#tblArticles tbody tr:last-child td{
	border-bottom:none;
}
table#tblArticles tr td:first-child{
	text-align:right;
}
table#tblArticles tr td:last-child{
	text-align:center;
}
table#tblArticles tbody tr:first-child td:first-child{
	text-align:left;
}

tr.bold >td {
	font-weight:bold;
}

div[data-test="template"]{
	background:#FFFFCC;
	border:solid 2px #FFCC66;
	left:0;	top:0; bottom:0;
	max-width:40%;
	opacity:0.7;
	overflow-x:hidden;
	padding:10px;
	position:fixed;
	text-align:left;
	
	width:260px;
	z-index:1;
}
div[data-test="template"] h4{
	margin:4px 0 0;
}
div[data-test="template"]:hover{
	opacity:1;
}
div[data-test="template"] 
	div#tmpl-blocks
		> div > div {
	margin-left:20px;
}
div#test_block_appearance{
	position:absolute;
	right:4px;
	top:2px;
}
td[data-article-id]{
	cursor:default;
}
td[data-article-id]:hover{
	background:#08C;
	color:#FFF;
}
.wclose{
	background:url(<?=$url?>/images/gtk-cancel.png);
	cursor:pointer;
	height:22px;
	position:absolute;
	right:-25px;
	top:-2px;
	width:22px; 
}
.wclose.inside{
	right:0;
}
</style>

