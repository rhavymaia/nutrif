package br.edu.ifpb.ifnutri.activity;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioGroup;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.CadastrarAlunoAsyncTask;
import br.edu.ifpb.ifnutri.entidade.Entrevistado;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class CadastrarEntrevistadoActivity extends Activity implements
		OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		setContentView(R.layout.activity_cadastra_aluno);

		Button button = (Button) findViewById(R.id.bcontCadastra);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {

		// Toast toast = Toast.makeText(this, "Cadastrando...!",
		// Toast.LENGTH_SHORT);
		// toast.show();

		EditText nome = (EditText) findViewById(R.id.nomeEditText);
		EditText login = (EditText) findViewById(R.id.loginEditText);
		EditText senha = (EditText) findViewById(R.id.senha);
		EditText matricula = (EditText) findViewById(R.id.matriculaEditText);
		// EditText nascimento = (EditText)
		// findViewById(R.id.nascimentoEditText);
		RadioGroup radioGroupNivel = (RadioGroup) findViewById(R.id.radioGroupNivel);
		RadioGroup radioGroupSexo = (RadioGroup) findViewById(R.id.radioGroupSexo);
		DatePicker datanasc = (DatePicker) findViewById(R.id.dataNascimento);
		
		boolean val1 = Validator
				.validateNotNull(nome, "Preencha o campo nome");
		boolean val2 = Validator
				.validateNotNull(login, "Preencha o campo login");
		boolean val3 = Validator
				.validateNotNull(senha, "Preencha o campo senha");
		boolean val4 = Validator
				.validateNotNull(matricula, "Preencha o campo matrícula");
	
		if(val1 == true && val2 == true && val3 == true && val4 == true){
		int mes = datanasc.getMonth() + 1;
		int dia = datanasc.getDayOfMonth();
		int ano = datanasc.getYear();

		String data = null;

		if (mes < 10)
			data = ano + "-0" + mes + "-" + dia;
		else
			data = ano + "-" + mes + "-" + dia;


		Entrevistado entrevistado = new Entrevistado();

		switch (radioGroupNivel.getCheckedRadioButtonId()) {
		case R.id.radioIntegrado:
			entrevistado.setNivelEscolar("1");
			break;
		case R.id.radioSubsequente:
			entrevistado.setNivelEscolar("2");
			break;
		case R.id.radioSuperior:
			entrevistado.setNivelEscolar("3");
			break;
		}

		switch (radioGroupSexo.getCheckedRadioButtonId()) {
		case R.id.radiomasc:
			entrevistado.setSexo("m");
			break;
		case R.id.radiofem:
			entrevistado.setSexo("f");
			break;
		}

		entrevistado.setNome(nome.getText().toString());
		entrevistado.setLogin(login.getText().toString());
		entrevistado.setSenha(senha.getText().toString());
		entrevistado.setMatricula(matricula.getText().toString());
		entrevistado.setNascimento(data);

		try {
			sendJSONObject(entrevistado);
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		if (validaEntrevistado(entrevistado)) {

		}
	}
	}
	private boolean validaEntrevistado(Entrevistado entrevistado) {
		return true;
	}
	
	protected void sendJSONObject(Entrevistado entrevistado)
			throws JSONException {

		JSONObject jsonObject = new JSONObject();

		jsonObject.put("nome", entrevistado.getNome());
		jsonObject.put("login", entrevistado.getLogin());
		jsonObject.put("senha", entrevistado.getSenha());
		jsonObject.put("sexo", entrevistado.getSexo());
		jsonObject.put("nivel", entrevistado.getNivelEscolar());
		jsonObject.put("nascimento", entrevistado.getNascimento());
		jsonObject.put("matricula", entrevistado.getMatricula());

		CadastrarAlunoAsyncTask cadastrarAsyncTask = new CadastrarAlunoAsyncTask(
				this);
		cadastrarAsyncTask.execute(jsonObject);
	}
	
}
