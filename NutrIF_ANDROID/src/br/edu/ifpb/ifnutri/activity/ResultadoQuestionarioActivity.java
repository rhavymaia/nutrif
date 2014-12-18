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
			mensagem.setText("Voc� precisa tornar sua alimenta��o e seus h�bitos de vida" +
					" mais saud�veis! D� mais aten��o � alimenta��o e atividade" +
					" f�sica.");
			Button bVoltar = (Button) findViewById(R.id.bvoltar1);
			bVoltar.setOnClickListener(this);
		}
		
		if (total >= 29 && total <= 42) {
			setContentView(R.layout.activity_resultado_questionario);
			this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
			TextView pontuacao = (TextView) findViewById(R.id.valorpontuacao);
			pontuacao.setText(String.format("%d",total));
			TextView mensagem = (TextView) findViewById(R.id.mensagem);
			mensagem.setText("Fique atento com sua alimenta��o e outros h�bitos como" +
					" atividade f�sica e consumo de l�quidos.");
			Button bVoltar = (Button) findViewById(R.id.bvoltar1);
			bVoltar.setOnClickListener(this);
		}
		
		if (total >= 43) {
			setContentView(R.layout.activity_resultado_questionario);
			this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
			TextView pontuacao = (TextView) findViewById(R.id.valorpontuacao);
			pontuacao.setText(String.format("%d",total));
			TextView mensagem = (TextView) findViewById(R.id.mensagem);
			mensagem.setText("Parab�ns! Voc� est� no caminho para o modo de vida saud�vel." +
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