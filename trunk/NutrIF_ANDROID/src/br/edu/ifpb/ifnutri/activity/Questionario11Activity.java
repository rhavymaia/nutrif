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
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.VCTAsyncTask;
import br.edu.ifpb.ifnutri.entidade.DadosVCT;
import br.edu.ifpb.ifnutri.entidade.GlobalState;
import br.edu.ifpb.ifnutri.entidade.Usuario;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class Questionario11Activity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_questionario11);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bContinuar);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {


			RadioButton radio1 = (RadioButton) findViewById(R.id.quest11op1);
			RadioButton radio2 = (RadioButton) findViewById(R.id.quest11op2);
			RadioButton radio3 = (RadioButton) findViewById(R.id.quest11op3);
			RadioButton radio4 = (RadioButton) findViewById(R.id.quest11op4);
			RadioButton radio5 = (RadioButton) findViewById(R.id.quest11op5);
			
	
			if (radio1.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 4;
			}
			if (radio2.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 3;
			}
			if (radio3.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 2;
			}
			if (radio4.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 1;
			}
			if (radio5.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 0;
			}

			Intent i = new Intent(this, Questionario12Activity.class);
            startActivity(i);

	}
}
