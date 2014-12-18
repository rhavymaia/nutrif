package br.edu.ifpb.ifnutri.asynctask;

import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.activity.TelaPrincipal;
import br.edu.ifpb.ifnutri.entidade.GlobalState;
import br.edu.ifpb.ifnutri.entidade.Usuario;
import br.edu.ifpb.ifnutri.service.HTTPService;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class LoginAlunoAsyncTask extends
		AsyncTask<JSONObject, Void, HttpResponse> {

	private Activity activity;

	public LoginAlunoAsyncTask(Activity activity) {
		this.activity = activity;
	}

	@Override
	protected void onPreExecute() {
		super.onPreExecute();
	}

	/**
	 * Login do usuário
	 * 
	 * @param usuario
	 * JSON {login:"valor", senha:"valor"}
	 * 
	 * @return
	 * SUCESS: JSON { codigo: HTTP-202, login: "user4@local.com",
	 * nome:"João Silva", tipoUsuario: "1", ativo: TRUE | FALSE }
	 * 
	 * FAIL: (http - 400) JSON{ codigo: [1-9], mensagem: "Erro" }
	 */
	@Override
	protected HttpResponse doInBackground(JSONObject... jsonObjects) {

		// Enviar a requisição HTTP via GET.
		HTTPService httpService = new HTTPService();
		HttpResponse response = httpService.sendJsonPostRequest(
				"/verificarLogin", jsonObjects[0]);
		return response;
	}
	
	@Override
	protected void onPostExecute(HttpResponse response) {

		int httpCode = response.getStatusLine().getStatusCode();

		try {
			// Conversão do response ( resposta HTTP) para String.
			String json = HttpUtil.entityToString(response);
			Log.i("Login Aluno", "Resquest - GET: " + json);

			JSONObject jsonObject = new JSONObject(json);
						
			if (httpCode == HttpStatus.SC_ACCEPTED) {

				String nascimento = jsonObject.getString("nascimento");
				String sexo = jsonObject.getString("sexo");
				int idUsuario = Integer.parseInt(jsonObject.getString("codigo"));
				String nome = jsonObject.getString("nome");
				int tipo = Integer.parseInt(jsonObject.getString("tipoUsuario"));
				
				Usuario usuario = new Usuario();
				usuario.setNome(nome);
				usuario.setSexo(sexo);
				usuario.setIdUsuario(idUsuario);
				usuario.setNascimento(nascimento);
				usuario.setTipoUsuario(tipo);
				
				GlobalState gs = (GlobalState) activity.getApplication();
				gs.setUsuario(usuario);
				
				Toast.makeText(activity.getApplicationContext(),
						"Bem vindo, " + nome,
						Toast.LENGTH_SHORT).show();

				Intent intent = new Intent(activity, TelaPrincipal.class);
				activity.startActivity(intent);
				activity.finish();

			} else {
				Toast.makeText(activity.getApplicationContext(),
						jsonObject.getString("mensagem"), Toast.LENGTH_SHORT)
						.show();
			}

		} catch (JSONException e) {
			Log.e("Login Aluno", "Error parsing data " + e.toString());
		}
	}

}
