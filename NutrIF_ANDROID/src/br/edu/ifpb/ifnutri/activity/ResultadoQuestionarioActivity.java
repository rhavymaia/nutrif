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

public class ResultadoQuestionarioActivity extends Activity implements OnClickListener {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		int total = ApresentaQuestionarioActivity.somatorio;
		ApresentaQuestionarioActivity.somatorio = 0;

		
		if (total <= 28) {
			setContentView(R.layout.activity_resultado_questionario);
			this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
			TextView pontuacao = (TextView) findViewById(R.id.valorpontuacao);
			pontuacao.setText(String.format("%d",total));
			TextView mensagem = (TextView) findViewById(R.id.mensagem);
			mensagem.setText("Você precisa tornar sua alimentação e seus hábitos de vida" +
					" mais saudáveis! Dê mais atenção à alimentação e atividade" +
					" física.");
			Button bVoltar = (Button) findViewById(R.id.bvoltar1);
			bVoltar.setOnClickListener(this);
		}
		
		if (total >= 29 && total <= 42) {
			setContentView(R.layout.activity_resultado_questionario);
			this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
			TextView pontuacao = (TextView) findViewById(R.id.valorpontuacao);
			pontuacao.setText(String.format("%d",total));
			TextView mensagem = (TextView) findViewById(R.id.mensagem);
			mensagem.setText("Fique atento com sua alimentação e outros hábitos como" +
					" atividade física e consumo de líquidos.");
			Button bVoltar = (Button) findViewById(R.id.bvoltar1);
			bVoltar.setOnClickListener(this);
		}
		
		if (total >= 43) {
			setContentView(R.layout.activity_resultado_questionario);
			this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
			TextView pontuacao = (TextView) findViewById(R.id.valorpontuacao);
			pontuacao.setText(String.format("%d",total));
			TextView mensagem = (TextView) findViewById(R.id.mensagem);
			mensagem.setText("Parabéns! Você está no caminho para o modo de vida saudável." +
					"Mantenha um dia-a-dia ativo!");
			Button bVoltar = (Button) findViewById(R.id.bvoltar1);
			bVoltar.setOnClickListener(this);
		}
	}

	@Override
	public void onClick(View arg0) {
		Intent intent = new Intent(this, TelaPrincipal.class);
		startActivity(intent);
	}

}