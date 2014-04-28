<!doctype>
<html>
<head>
	<title>jsPDF</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.17.custom.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script type="text/javascript" src="js/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="js/jspdf.js"></script>
	<script type="text/javascript" src="libs/FileSaver.js/FileSaver.js"></script>
	<script type="text/javascript" src="libs/Blob.js/BlobBuilder.js"></script>

	<script type="text/javascript" src="js/jspdf.plugin.addimage.js"></script>

	<script type="text/javascript" src="js/jspdf.plugin.standard_fonts_metrics.js"></script>
	<script type="text/javascript" src="js/jspdf.plugin.split_text_to_size.js"></script>
	<script type="text/javascript" src="js/jspdf.plugin.from_html.js"></script>
	<script type="text/javascript" src="js/basic.js"></script>
	 
	<script>
		$(function() {
			$("#accordion-basic, #accordion-text, #accordion-graphic").accordion({
				autoHeight: false,
				navigation: true
			});
			$( "#tabs" ).tabs();
			$(".button").button();
		});
	</script>
</head>

<body>
<iframe frameborder="0" width="100%" height="100%"></iframe>
<script>
$(document).ready(function() {
    doc = new jsPDF();
    doc.setFontSize(40);
    
    //pdf code starts here    
    doc.setFontSize(22);
    doc.text(20, 20, 'INB201 Harmony Hospital');

    doc.setFontSize(16);
    doc.text(20, 30, '(sql query here)');
    //end pdf code
    
	var string = doc.output('datauristring');

	$('iframe').attr('src', string);
})
</script>
</body>
</html>
