/* Para mostrar menu */
$( ".cross" ).hide();
$( ".menu" ).hide();
$( ".hamburger" ).click(function() {
	$( ".menu" ).slideToggle( "fast", function() {
		$( ".cross" ).show();
	});
})

/* Para la búsqueda */
$('#botonsearch').click(function() {
	var buscado = $('#inputsearchcab').val();
	console.log("mira:"+buscado+"YA");
	if(buscado!="" || buscado==undefined)
		window.location="busqueda?search_query="+buscado;
})