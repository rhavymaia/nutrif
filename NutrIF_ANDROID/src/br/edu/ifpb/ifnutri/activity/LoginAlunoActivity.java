package br.edu.ifpb.ifnutri.activity;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import br.edu.ifpb.ifnutri.R;
import br.edu.ifpb.ifnutri.asynctask.LoginAlunoAsyncTask;

public class LoginAlunoActivity extends Activity implements OnClickListener {

        @Override
        protected void onCreate(Bundle savedInstanceState) {
                super.onCreate(savedInstanceState);
                setContentView(R.layout.activity_login_aluno);
                ActionBar act = getActionBar();
                act.hide();
                this.setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);

                Button bEntrar = (Button) findViewById(R.id.bLogin);
                Button bCadastro = (Button) findViewById(R.id.bCadastro);
                bEntrar.setOnClickListener(this);
                bCadastro.setOnClickListener(this);
        }

        public void onClick(View v) {

                EditText login = (EditText) findViewById(R.id.loginEditText);
                EditText senha = (EditText) findViewById(R.id.senhaEditText);

                switch (v.getId()) {
                case R.id.bLogin:
                        logarUsuario(login.getText().toString(), senha.getText().toString());
                        break;
                case R.id.bCadastro:
                        Intent i1 = new Intent(this, CadastrarEntrevistadoActivity.class);
                        startActivity(i1);
                        break;
                }

        }

        private void logarUsuario(String login, String senha) {
                JSONObject jsonObject = new JSONObject();

                try {
                        jsonObject.put("login", login);
                        jsonObject.put("senha", senha);

                        LoginAlunoAsyncTask LogAsyncTask = new LoginAlunoAsyncTask(this);
                        LogAsyncTask.execute(jsonObject);
                        
                } catch (JSONException e) {
                        Log.e("IFNutri", e.getMessage());
                        // Toast para o usuário com erro mais suave.
                }
        }
}