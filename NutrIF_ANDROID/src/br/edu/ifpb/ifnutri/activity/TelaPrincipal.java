package br.edu.ifpb.ifnutri.activity;



import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.R;


public class TelaPrincipal extends Activity implements OnClickListener{

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_tela_principal);
		ActionBar act = getActionBar();
        act.hide();
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
		
        Button bNovaAnamnese = (Button) findViewById(R.id.bNovaAnamnese);
		Button bCalcularIMC = (Button) findViewById(R.id.bCalcularIMC);
		Button bCalcularVCT = (Button) findViewById(R.id.bCalcularVCT);
        Button bHistoricoAnamnese = (Button) findViewById(R.id.bHistoricoAnamnese);
        Button bPerfilAlimentar = (Button) findViewById(R.id.bPerfilAlimentar);
        Button bSair = (Button) findViewById(R.id.bSair);
        
        bNovaAnamnese.setOnClickListener(this);
        bCalcularIMC.setOnClickListener(this);
        bCalcularVCT.setOnClickListener(this);
        bPerfilAlimentar.setOnClickListener(this);
        bHistoricoAnamnese.setOnClickListener(this);
        bSair.setOnClickListener(this);
    }
 
    public void onClick(View v) {
		switch (v.getId()) {
        case R.id.bNovaAnamnese:
        	Intent i = new Intent(this, NovaAnamneseActivity.class);
            startActivity(i);
            break;
        case R.id.bCalcularIMC:
            Intent i1 = new Intent(this, CalcularIMCActivity.class);
            startActivity(i1);
            break;
        case R.id.bCalcularVCT:
        	Intent i2 = new Intent(this, CalcularVCTActivity.class);
            startActivity(i2);
            break;
        case R.id.bHistoricoAnamnese:
        	Toast.makeText(this,
					"Implementando...", Toast.LENGTH_SHORT)
					.show();
            break;
        case R.id.bPerfilAlimentar:
        	Intent i3 = new Intent(this, ApresentaQuestionarioActivity.class);
            startActivity(i3);
        	
            break;
        case R.id.bSair:
            Intent intent = new Intent(Intent.ACTION_MAIN);
            intent.addCategory(Intent.CATEGORY_HOME);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);
        }


		
}
}	
	

