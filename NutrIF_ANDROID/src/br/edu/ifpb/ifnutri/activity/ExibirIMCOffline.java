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

public class ExibirIMCOffline extends Activity implements OnClickListener{


    @Override
    protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            
            double imc = CapturarDadosIMCOffline.imc;
            
            
            if(imc<=18.49){
            	setContentView(R.layout.activity_abaixo_peso);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc   = (TextView) findViewById(R.id.valorimc);
                valorimc.setText(String.format("%.2f",imc));
                Button bVoltar = (Button) findViewById(R.id.bvoltar);
                bVoltar.setText("Calcular novamente");
                bVoltar.setOnClickListener(this);
            }if(imc>=18.5 && imc<25){
            	setContentView(R.layout.activity_normal_peso);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc1   = (TextView) findViewById(R.id.valorimc1);
            	valorimc1.setText(String.format("%.2f",imc));
            	Button bVoltar1 = (Button) findViewById(R.id.bvoltar1);
            	bVoltar1.setText("Calcular novamente");
                bVoltar1.setOnClickListener(this);
            }if(imc>=25 && imc<30){
            	setContentView(R.layout.activity_sobrepeso);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc2   = (TextView) findViewById(R.id.valorimc2);
            	valorimc2.setText(String.format("%.2f",imc));
            	Button bVoltar2 = (Button) findViewById(R.id.bvoltar2);
            	bVoltar2.setText("Calcular novamente");
                bVoltar2.setOnClickListener(this);
            }if(imc>=30 && imc<35){
            	setContentView(R.layout.activity_obesidade_leve);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc3   = (TextView) findViewById(R.id.valorimc3);
            	valorimc3.setText(String.format("%.2f",imc));
            	Button bVoltar3 = (Button) findViewById(R.id.bvoltar3);
            	bVoltar3.setText("Calcular novamente");
                bVoltar3.setOnClickListener(this);
            }if(imc>=35 && imc<40){
            	setContentView(R.layout.activity_obesidade_moderada);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc4   = (TextView) findViewById(R.id.valorimc4);
            	valorimc4.setText(String.format("%.2f",imc));
            	Button bVoltar4 = (Button) findViewById(R.id.bvoltar4);
            	bVoltar4.setText("Calcular novamente");
                bVoltar4.setOnClickListener(this);
            }if(imc>=40){
            	setContentView(R.layout.activity_obesidade_avancada);
            	ActionBar act = getActionBar();
                act.hide();
            	this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
            	TextView valorimc5   = (TextView) findViewById(R.id.valorimc5);
            	valorimc5.setText(String.format("%.2f",imc));
            	Button bVoltar5 = (Button) findViewById(R.id.bvoltar5);
            	bVoltar5.setText("Calcular novamente");
                bVoltar5.setOnClickListener(this);
            }

            
    }

    @Override
    public void onClick(View arg0) {
    	Intent intent = new Intent(this,CapturarDadosIMCOffline.class);
		startActivity(intent);
    }

}