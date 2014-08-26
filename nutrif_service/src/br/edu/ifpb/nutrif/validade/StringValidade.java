package br.edu.ifpb.nutrif.validade;


public class StringValidade {
	
	public static boolean isEmpty(String valor){
		
		boolean ehVazio = true;
		
		if (valor != null && valor.trim().length() != 0 ) {
			
			ehVazio = false;
		}
		
		return ehVazio;
	}
}
