package br.edu.ifpb.ifnutri.asynctask;

import org.apache.http.HttpResponse;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.activity.ResultadoVCTActivity;
import br.edu.ifpb.ifnutri.service.HTTPService;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class VCTAsyncTask extends
		AsyncTask<JSONObject, Void, HttpResponse> {

	public static double vct = 0;
	private Activity activity;

	public VCTAsyncTask(Activity activity) {
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
		HttpResponse response = httpService.sendJsonPostRequest("/calcularVCT",
				jsonObjects[0]);
		return response;
	}

	@Override
	protected void onPostExecute(HttpResponse response) {

		int httpCode = response.getStatusLine().getStatusCode();

		try {
			// Conversão do response ( resposta HTTP) para String.
			String json = HttpUtil.entityToString(response);
			Log.i("VCT", "Resquest - GET: " + json);

			JSONObject jsonObject = new JSONObject(json);

			if (httpCode == 200) {
                String vcts = jsonObject.getString("valor");
                vct = Double.parseDouble(vcts);
				Intent intent = new Intent(activity, ResultadoVCTActivity.class);
				activity.startActivity(intent);
				activity.finish();

			} else {
				Toast.makeText(activity.getApplicationContext(),
						"Erro no calculo", Toast.LENGTH_SHORT)
						.show();
			}

		} catch (JSONException e) {
			Log.e("VCT", "Error parsing data " + e.toString());
		}
	}
}

