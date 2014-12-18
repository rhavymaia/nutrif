package br.edu.ifpb.ifnutri.activity;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class CapturarDadosIMCOffline extends Activity implements OnClickListener {
	
	public static double imc;

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

			double p = (Double) Double.parseDouble(vpeso.getText().toString());
			double a = (Double) Double.parseDouble(valtura.getText().toString());
			
			imc = p/(a*a);
			
			Intent i = new Intent(this, ExibirIMCOffline.class);
            startActivity(i);
		}

	}
}
