package br.edu.ifpb.ifnutri.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import br.edu.ifpb.ifnutri.R;


public class CalcularIMCActivity extends Activity implements OnClickListener{


    @Override
    protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_apresenta_imc);

            Button button = (Button) findViewById(R.id.bCalcular);
            button.setOnClickListener(this);
    }

    @Override
    public void onClick(View arg0) {
    	Intent i = new Intent(this, CapturarDadosIMC.class);
        startActivity(i);
    }
}