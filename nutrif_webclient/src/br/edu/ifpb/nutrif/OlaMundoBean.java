package br.edu.ifpb.nutrif;

import java.text.SimpleDateFormat;
import java.util.Date;

import javax.faces.bean.ManagedBean;

@ManagedBean
public class OlaMundoBean {

	private String horario;
	
	public String getHorario() {
		SimpleDateFormat sdf = new SimpleDateFormat("hh:mm:ss");
		return "Atualizado em " + sdf.format(new Date());
	}

	public void setHorario(String horario) {
		this.horario = horario;
	}
}