package br.edu.ifpb.ifnutri.activity;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.CalcularIMCAsyncTask;
import br.edu.ifpb.ifnutri.entidade.DadosIMC;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class CapturarDadosIMC extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_captura_imc);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bcontinuar);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {

		EditText vpeso = (EditText) findViewById(R.id.peso);
		EditText valtura = (EditText) findViewById(R.id.altura);
		
		boolean val1 = Validator
				.validateNotNull(vpeso, "Preencha o campo peso");
		boolean val2 = Validator.validateNotNull(valtura,
				"Preencha o campo altura");

		if (val1 == true && val2 == true) {

			DadosIMC dados = new DadosIMC();
			String p = (String) vpeso.getText().toString();
			dados.setPeso((Double) Double.parseDouble(p));
			String a = (String) valtura.getText().toString();
			dados.setAltura((Double) Double.parseDouble(a));

			JSONObject jsonObject = new JSONObject();

	        try {
	                jsonObject.put("peso", p);
	                jsonObject.put("altura", a);

	                CalcularIMCAsyncTask LogAsyncTask = new CalcularIMCAsyncTask(this);
	                LogAsyncTask.execute(jsonObject);
	                
	        } catch (JSONException e) {
	                Log.e("IFNutri", e.getMessage());

	        }
		}

	}
}
