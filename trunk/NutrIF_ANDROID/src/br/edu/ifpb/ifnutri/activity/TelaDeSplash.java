package br.edu.ifpb.ifnutri.activity;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.os.Handler;
import android.widget.Toast;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.VerificarConexaoAsyncTask;
import br.edu.ifpb.ifnutri.service.HttpUtil;

public class TelaDeSplash extends Activity implements Runnable {

	private final int DURAÇAO_SPLASH_SCREEN = 3000;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_splash);
		this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);

		Handler hand = new Handler();
		hand.postDelayed(this, DURAÇAO_SPLASH_SCREEN);
	}

	@Override
	public void run() {
		
		if (HttpUtil.isConnect(this)) {
			VerificarConexaoAsyncTask verificaConexao = new VerificarConexaoAsyncTask(
					this);
			verificaConexao.execute();
		} else {
			Toast.makeText(this,
					"Sem conexão, a única opção disponível offline é o cálculo do IMC", Toast.LENGTH_SHORT)
					.show();
			Intent i = new Intent(this, CapturarDadosIMCOffline.class);
			startActivity(i);
		}
	}
}
