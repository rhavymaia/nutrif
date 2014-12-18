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
import android.widget.RadioButton;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.AutoAnamneseAsyncTask;
import br.edu.ifpb.ifnutri.entidade.DadosVCT;
import br.edu.ifpb.ifnutri.entidade.GlobalState;
import br.edu.ifpb.ifnutri.entidade.Usuario;
import br.edu.ifpb.ifnutri.validacao.Validator;

public class NovaAnamneseActivity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_captura_vct);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		Button button = (Button) findViewById(R.id.bContinuarCapVCT);
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

			DadosVCT dados = new DadosVCT();
			String p = (String) vpeso.getText().toString();
			dados.setPeso((Double) Double.parseDouble(p));
			String a = (String) valtura.getText().toString();
			dados.setAltura((Double) Double.parseDouble(a));

			RadioButton radio1 = (RadioButton) findViewById(R.id.radioLeve2);
	        RadioButton radio2 = (RadioButton) findViewById(R.id.radioMod2);
	        RadioButton radio3 = (RadioButton) findViewById(R.id.radioAva2);
	        
	        int op=0;

	        if(radio1.isChecked()){
	        	op=1;
	        }
	        if(radio2.isChecked()){
				op=2;
	        }
	        if(radio3.isChecked()){
				op=3;
	        }
	        
	        GlobalState gb = (GlobalState) getApplication();
			Usuario usuario = new Usuario();
			usuario = gb.getUsuario();
			int cdUsuario = usuario.getIdUsuario();
			int tipo = usuario.getTipoUsuario();
	        
	        JSONObject jsonObject = new JSONObject();
	        JSONObject jsonObjectEntrevistado = new JSONObject();
	        
	        try {
	        	
	        		
	        		jsonObjectEntrevistado.put("cdEntrevistado", cdUsuario);
	        		jsonObjectEntrevistado.put("tipoEntrevistado", tipo);
	        		jsonObject.put("entrevistado", jsonObjectEntrevistado);
	                jsonObject.put("peso", p);
	                jsonObject.put("altura", a);
	                jsonObject.put("nivelEsporte", op);

	               
	                AutoAnamneseAsyncTask LogAsyncTask = new AutoAnamneseAsyncTask(this);
	                LogAsyncTask.execute(jsonObject);
	                
	        } catch (JSONException e) {
	                Log.e("IFNutri", e.getMessage());

	        }
		}

	}
}
