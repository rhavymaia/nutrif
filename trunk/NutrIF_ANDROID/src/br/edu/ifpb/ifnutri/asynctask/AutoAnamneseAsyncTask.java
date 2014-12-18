package br.edu.ifpb.ifnutri.asynctask;

import org.apache.http.HttpResponse;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.activity.ResultadoAutoAnamneseActivity;
import br.edu.ifpb.ifnutri.service.HTTPService;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class AutoAnamneseAsyncTask extends
		AsyncTask<JSONObject, Void, HttpResponse> {

	private Activity activity;
	public static double vct;
	public static double imc;

	public AutoAnamneseAsyncTask(Activity activity) {
		this.activity = activity;
	}

	@Override
	protected void onPreExecute() {
		super.onPreExecute();
	}

	@Override
	protected HttpResponse doInBackground(JSONObject... jsonObjects) {

		// Enviar a requisição HTTP via GET.
		HTTPService httpService = new HTTPService();
		HttpResponse response = httpService.sendJsonPostRequest("/realizarAutoAnamneseEntrevistado",
				jsonObjects[0]);
		return response;
	}

	@Override
	protected void onPostExecute(HttpResponse response) {

		int httpCode = response.getStatusLine().getStatusCode();

		try {
			// Conversão do response ( resposta HTTP) para String.
			String json = HttpUtil.entityToString(response);
			Log.i("AutoAnamnese", "Resquest - GET: " + json);

			JSONObject jsonObject = new JSONObject(json);

			if (httpCode == 200) {
				String vcts = jsonObject.getString("vct");
	            vct = Double.parseDouble(vcts);
				String imcs = jsonObject.getString("imc");
				imc = Double.parseDouble(imcs);
				Intent intent = new Intent(activity, ResultadoAutoAnamneseActivity.class);
				activity.startActivity(intent);
				activity.finish();

			} else {
				Toast.makeText(activity.getApplicationContext(),
						jsonObject.getString("mensagem"), Toast.LENGTH_SHORT)
						.show();
			}

		} catch (JSONException e) {
			Log.e("AutoAnamnese", "Error parsing data " + e.toString());
		}
	}
}
