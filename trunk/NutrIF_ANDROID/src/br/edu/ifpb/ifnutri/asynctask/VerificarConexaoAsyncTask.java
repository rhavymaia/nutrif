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

public class VerificarConexaoAsyncTask extends
		AsyncTask<Void, Void, JSONObject> {

	private Activity activity;

	public VerificarConexaoAsyncTask(Activity activity) {
		this.activity = activity;
	}

	@Override
	protected void onPreExecute() {
		// TODO Auto-generated method stub
		super.onPreExecute();
	}

	@Override
	protected JSONObject doInBackground(Void... params) {

		JSONObject jsonObject = null;

		// Enviar a requisição HTTP via GET.
		HTTPService httpService = new HTTPService();
		HttpResponse response = httpService.sendGETRequest("/statusServer");

		// Conversão do response ( resposta HTTP) para String.
		String json = HttpUtil.entityToString(response);

		Log.i("Verifica conexão AsyncTaskKJson", "Resquest - GET: " + json);

		try {

			jsonObject = new JSONObject(json);

		} catch (JSONException e) {

			Log.e("Verifica conexão AsyncTaskKJson",
					"Error parsing data " + e.toString());
		}

		return jsonObject;
	}

	/*
	 * INPUT: JSON{ codigo: HTTP_CRIADO, online: TRUE }
	 */

	@Override
	protected void onPostExecute(JSONObject result) {

		try {

			String online = result.getString("online");

			Log.i("Verifica conexão AsyncTaskKJson", "Servidor conectado: "
					+ online);

			if (Boolean.valueOf(online)) {
				Toast.makeText(activity.getApplicationContext(), "Online",
						Toast.LENGTH_SHORT).show();

				Intent intent = new Intent(activity, LoginAlunoActivity.class);
				activity.startActivity(intent);
				activity.finish();
			} else {

				Toast.makeText(activity.getApplicationContext(), "Offline",
						Toast.LENGTH_SHORT).show();
			}

		} catch (JSONException e) {
			Log.e("Verifica conexão AsyncTaskKJson",
					"Error parsing data " + e.toString());
		}

	}

}
