package br.edu.ifpb.ifnutri.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import br.edu.ifpb.ifnutri.R;

public class CalcularVCTActivity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_apresenta_vct);

		Button button = (Button) findViewById(R.id.bCalcularVCT);
		button.setOnClickListener(this);
	}

	@Override
	public void onClick(View arg0) {
		Intent intent = new Intent(this, CapturarDadosVCT.class);
		startActivity(intent);
	}

}