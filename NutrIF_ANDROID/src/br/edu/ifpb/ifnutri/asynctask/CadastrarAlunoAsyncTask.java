package br.edu.ifpb.ifnutri.asynctask;

import org.apache.http.HttpResponse;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.activity.LoginAlunoActivity;
import br.edu.ifpb.ifnutri.service.HTTPService;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class CadastrarAlunoAsyncTask extends
		AsyncTask<JSONObject, Void, HttpResponse> {
	
	private Activity activity;

	public CadastrarAlunoAsyncTask(Activity activity) {
		this.activity = activity;
	}
	@Override
	protected void onPreExecute() {
		super.onPreExecute();
	}
	
	/**
	OUTPUT:		JSON{
			      	nome: "valor", 
			      	login: "user@local.com", 
			      	senha: "valor", matricula: [1-9],
			 	    nascimento: "dd/mm/YYYY",
			 	    nivel: [1-3],
			 	    sexo: "M" | "F"
		 	    }
 	*/

	@Override
	protected HttpResponse doInBackground(JSONObject... jsonObjects) {

		// Enviar a requisição HTTP via GET.
		HTTPService httpService = new HTTPService();
		HttpResponse response = httpService.sendJsonPostRequest(
				"/cadastrarAluno", jsonObjects[0]);
		return response;
	}

	/**	
	INPUT:		
				SUCESS:
				(http - 200)
				JSON{
					idUsuario: [1-9],
					idEntrevistado: [1-9]
				}
				
				FAIL:
			    (http - 400)
				JSON{
					codigo: [1-9],
					mensagem: "Erro"
				} 
 	*/
	
	@Override
	protected void onPostExecute(HttpResponse response) {

		int httpCode = response.getStatusLine().getStatusCode();
		
		try {
			// Conversão do response ( resposta HTTP) para String.
			String json = HttpUtil.entityToString(response);
			Log.i("Cadastro de Aluno", "Resquest - GET: "+ json);

			JSONObject jsonObject = new JSONObject(json);
			
			String msg = jsonObject.getString("mensagem");

			if (httpCode == 201) {
				Toast.makeText(activity.getApplicationContext(), msg,
						Toast.LENGTH_SHORT).show();

				Intent intent = new Intent(activity, LoginAlunoActivity.class);
				activity.startActivity(intent);
				activity.finish();
			
			} else {
				Toast.makeText(activity.getApplicationContext(), msg,
						Toast.LENGTH_SHORT).show();

			}
			
		} catch (JSONException e) {
			Log.e("Cadastra Aluno", "Error parsing data " + e.toString());
		}
	}

}
