package br.edu.ifpb.ifnutri.activity;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.AutoAnamneseAsyncTask;

public class ResultadoAutoAnamneseActivity extends Activity implements OnClickListener {
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            
                setContentView(R.layout.activity_resultado_nova_anamnese);
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorVCT = (TextView) findViewById(R.id.valorVCT);
                valorVCT.setText(String.format("%.2f", AutoAnamneseAsyncTask.vct));
                
                TextView valorIMC = (TextView) findViewById(R.id.valorIMC);
                valorIMC.setText(String.format("%.2f",AutoAnamneseAsyncTask.imc));
                  
                Button bVoltar = (Button) findViewById(R.id.bretornar);
                bVoltar.setOnClickListener(this);
            }
    

    @Override
    public void onClick(View arg0) {
    	Intent intent = new Intent(this,TelaPrincipal.class);
		startActivity(intent);
    }

}

