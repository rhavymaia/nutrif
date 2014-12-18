package br.edu.ifpb.ifnutri.asynctask;

import org.apache.http.HttpResponse;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.activity.IMCActivity;
import br.edu.ifpb.ifnutri.service.HTTPService;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class CalcularIMCAsyncTask extends
		AsyncTask<JSONObject, Void, HttpResponse> {

	public static double imc = 0;
	private Activity activity;

	public CalcularIMCAsyncTask(Activity activity) {
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
		HttpResponse response = httpService.sendJsonPostRequest("/calcularIMC",
				jsonObjects[0]);
		return response;
	}

	@Override
	protected void onPostExecute(HttpResponse response) {

		int httpCode = response.getStatusLine().getStatusCode();

		try {
			// Conversão do response ( resposta HTTP) para String.
			String json = HttpUtil.entityToString(response);
			Log.i("IMC", "Resquest - GET: " + json);

			JSONObject jsonObject = new JSONObject(json);

			if (httpCode == 202) {
                String imcs = jsonObject.getString("valor");
                imc = Double.parseDouble(imcs);
				Intent intent = new Intent(activity, IMCActivity.class);
				activity.startActivity(intent);
				activity.finish();

			} else {
				Toast.makeText(activity.getApplicationContext(),
						jsonObject.getString("mensagem"), Toast.LENGTH_SHORT)
						.show();
			}

		} catch (JSONException e) {
			Log.e("IMC", "Error parsing data " + e.toString());
		}
	}
}
