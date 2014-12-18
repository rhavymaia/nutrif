package br.edu.ifpb.ifnutri.activity;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.VCTAsyncTask;
import br.edu.ifpb.ifnutri.entidade.DadosVCT;
import br.edu.ifpb.ifnutri.entidade.GlobalState;
import br.edu.ifpb.ifnutri.entidade.Usuario;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class Questionario14Activity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_questionario14);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bContinuar);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {


			CheckBox check1 = (CheckBox) findViewById(R.id.quest14op1);
			CheckBox check2 = (CheckBox) findViewById(R.id.quest14op2);
			CheckBox check3 = (CheckBox) findViewById(R.id.quest14op3);
			CheckBox check4 = (CheckBox) findViewById(R.id.quest14op4);
			CheckBox check5 = (CheckBox) findViewById(R.id.quest14op5);
			CheckBox check6 = (CheckBox) findViewById(R.id.quest14op6);			
	
			int soma = 0;
			
			if (check1.isChecked()) {
				soma = soma + 1;
			}
			if (check2.isChecked()) {
				soma = soma + 1;
			}
			if (check3.isChecked()) {
				soma = soma + 1;
			}
			if (check4.isChecked()) {
				soma = soma + 1;
			}
			if (check5.isChecked()) {
				soma = soma + 1;
			}
			if (check6.isChecked()) {
				soma = soma + 1;
			}
			
			if (soma < 3){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 0;
			}
			if (soma >= 3 && soma <= 4){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 2;
			}
			if (soma >= 5 && soma <= 6){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 3;
			}

			Intent i = new Intent(this, Questionario15Activity.class);
            startActivity(i);

	}
}
