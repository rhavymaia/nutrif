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

public class Questionario6Activity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_questionario6);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bContinuar);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {


			RadioButton radio1 = (RadioButton) findViewById(R.id.quest6op1);
			RadioButton radio2 = (RadioButton) findViewById(R.id.quest6op2);
			RadioButton radio3 = (RadioButton) findViewById(R.id.quest6op3);
	
			if (radio1.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 3;
			}
			if (radio2.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 0;
			}
			if (radio3.isChecked()) {
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 2;
			}

			Intent i = new Intent(this, Questionario7Activity.class);
            startActivity(i);

	}
}
