package br.edu.ifpb.ifnutri.activity;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.VCTAsyncTask;

public class ResultadoVCTActivity extends Activity implements OnClickListener{
	
    @Override
    protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            
              double vct = VCTAsyncTask.vct;
            
            	setContentView(R.layout.activity_vct2);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorVCT = (TextView) findViewById(R.id.valorvct);
                valorVCT.setText(String.format("%.2f",vct));
                  
                Button bVoltar = (Button) findViewById(R.id.bretornar);
                bVoltar.setOnClickListener(this);
            }
    

    @Override
    public void onClick(View arg0) {
    	Intent intent = new Intent(this,TelaPrincipal.class);
		startActivity(intent);
    }

}