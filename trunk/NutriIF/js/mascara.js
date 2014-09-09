function include(file)
{

  var script  = document.createElement('script');
  script.src  = file;
  script.type = 'text/javascript';

  document.getElementsByTagName('head').item(0).appendChild(script);

}

include('jquery-1.6.1.js');
include('jquery.maskedinput-1.2.2.js');

jQuery(function($){
	     $("#telefone").mask("(99) 9999-9999"); 
	     $("#cep").mask("99999-999"); 
	     $("#data").mask("99/99/9999"); 
	     $("#cpf").mask("999.999.999-99"); 
	     $("#cnpj").mask("99.999.999/9999-99");
	}); 

