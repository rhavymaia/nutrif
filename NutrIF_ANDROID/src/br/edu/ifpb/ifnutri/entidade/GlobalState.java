package br.edu.ifpb.ifnutri.entidade;

import android.app.Application;

public class GlobalState extends Application{
	
	 private Usuario usuario;
	 boolean refresh = true;	 
	 
	 public void setRefresh(boolean refresh){
		 this.refresh = refresh;
	 }
	 
	 public boolean getRefresh(){
		 return refresh;
	 }

	public Usuario getUsuario() {
		return usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}
			 
}