package br.edu.ifpb.ifnutri.activity;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class IniciarApp extends BroadcastReceiver {
	 
    @Override
    public void onReceive(Context ctx, Intent i) {
        
        Intent intent = new Intent(ctx, TelaDeSplash.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        ctx.startActivity(intent);        
    }
}