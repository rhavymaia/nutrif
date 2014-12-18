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
import android.widget.TextView;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.VCTAsyncTask;
import br.edu.ifpb.ifnutri.entidade.DadosVCT;
import br.edu.ifpb.ifnutri.entidade.GlobalState;
import br.edu.ifpb.ifnutri.entidade.Usuario;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class Questionario4Activity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_questionario4);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bContinuar);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {


			EditText a = (EditText) findViewById(R.id.quest4op1);
			EditText b = (EditText) findViewById(R.id.quest4op2);
			EditText c = (EditText) findViewById(R.id.quest4op3);
			EditText d = (EditText) findViewById(R.id.quest4op4);
			
			boolean val1 = Validator
					.validateNotNull(a, "Preencha o campo");
			boolean val2 = Validator
					.validateNotNull(b, "Preencha o campo");
			boolean val3 = Validator
					.validateNotNull(c, "Preencha o campo");
			boolean val4 = Validator
					.validateNotNull(d, "Preencha o campo");
			
			if(val1 == true && val2 == true && val3 == true && val4 == true){
	
			int vA = (Integer) Integer.parseInt((String) a.getText().toString());
			int vB = (Integer) Integer.parseInt((String) b.getText().toString());
			int vC = (Integer) Integer.parseInt((String) c.getText().toString());
			int vD = (Integer) Integer.parseInt((String) d.getText().toString());
		
			double soma = (vA/3) + (vB/2) + (vC/1) + (vD/6);
			
			if(soma == 0){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 0;
			}
			if(soma < 3){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 1;
			}
			if(soma >= 3 && soma <= 4.4){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 2;
			}
			if(soma >= 4.5 && soma <= 7.5){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 3;
			}
			if(soma > 7.5){
				ApresentaQuestionarioActivity.somatorio = ApresentaQuestionarioActivity.somatorio + 4;
			}
			
			Intent i = new Intent(this, Questionario5Activity.class);
            startActivity(i);}

	}
}
