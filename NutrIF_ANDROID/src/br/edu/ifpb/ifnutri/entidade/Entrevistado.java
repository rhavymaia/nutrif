package br.edu.ifpb.ifnutri.entidade;

public class Entrevistado extends Usuario{

	private int idEntrevistado;
	
	private String matricula;
	
	private String nivelEscolar;

	public int getIdEntrevistado() {
		return idEntrevistado;
	}

	public void setIdEntrevistado(int idEntrevistado) {
		this.idEntrevistado = idEntrevistado;
	}

	public String getMatricula() {
		return matricula;
	}

	public void setMatricula(String matricula) {
		this.matricula = matricula;
	}

	public String getNivelEscolar() {
		return nivelEscolar;
	}

	public void setNivelEscolar(String nivelEscolar) {
		this.nivelEscolar = nivelEscolar;
	}
	
	
}
