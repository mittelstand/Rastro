//인트로
package com.example.rastro;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;

import Thread.FacebookLoginThread;
import Thread.loginThread;
import utility.NetworkConnectionCheck;
import utility.RbPreference;
/**
 * Created by 아연이 on 2015-01-23.
 */
public class intro extends Activity {
    ProgressDialog dialog = null;
    loginThread lT;
    FacebookLoginThread Flt;
    RbPreference pref;
    NetworkConnectionCheck NCC;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.intro);
        pref = new RbPreference(intro.this);
        if (pref.getValue("pwd", "") == "" && pref.getValue("email", "") == "") {
            Handler handler = new android.os.Handler();
            handler.postDelayed(new Runnable() {

                @Override
                public void run() {
                    // TODO Auto-generated method stub
                    Intent intent = new Intent(intro.this, JoinForm.class);
                    startActivity(intent);

                    finish();
                }
            }, 1000);
        }
        autoLogin();
    }
    public void autoLogin(){//자동로그인 기능

//        if(pref.getValue("pwd", "")=="" && pref.getValue("id", "")==""){
//            Intent intent = new Intent(intro.this,JoinForm.class);
//            startActivity(intent);
        if(pref.getValue("pwd","")!=""){//일반로그인 체크(비밀번호가 존재하면)
            String email1 = pref.getValue("email", "");
            String pwd1 = pref.getValue("pwd", "");
            String url = "http://rastro.kr/app/loginChk.php";
//			dialog = ProgressDialog.show(Intro.this, "", "Loading.....");
            isNetworkStat(intro.this);
            lT = new loginThread(email1, pwd1, url, mHandler,dialog);//로그인쓰레드
            lT.start();
        }if(pref.getValue("id", "")!=""){//페이스북으로 로그인체크(페이스북ID 존재하면)
            String email = pref.getValue("email", "");
            String url="http://rastro.kr/app/appFbLoginChk.php";
            isNetworkStat(intro.this);
//			dialog = ProgressDialog.show(Intro.this, "", "Loading.....");

            Flt = new FacebookLoginThread(mHandler, url,email);//페이스북쓰레드
            Flt.start();
        }

    }

    Handler mHandler;

    {
        mHandler = new Handler() {
            public void handleMessage(Message msg) {

                if (msg.what == 3) {//일반로그인
                    //성공 하였을때 JSON파싱했는 값 들고와서  보내기
                    Bundle bundle = msg.getData();
                    Intent intent = new Intent(intro.this, profileForm.class);
                    intent.putExtra("name", bundle.getString("name"));
                    intent.putExtra("email", bundle.getString("email"));
                    intent.putExtra("dob", bundle.getString("dob"));
                    intent.putExtra("sex", bundle.getString("sex"));
                    intent.putExtra("idx", bundle.getString("idx"));
                    intent.putExtra("fbcode",bundle.getString("fbcode"));
                    intent.putExtra("Ps", bundle.getString("Ps"));
                    startActivity(intent);
                    finish();
//				dialog.dismiss();
                    lT.interrupt();

                }

                if (msg.what == 7) {
                    //페이스북으로 로그인
                    Bundle bundle = msg.getData();
                    //성공 하였을때 JSON파싱했는 값 들고와서  보내기
                    Intent intent = new Intent(intro.this, profileForm.class);
                    intent.putExtra("name", bundle.getString("name"));
                    intent.putExtra("email", bundle.getString("email"));
                    intent.putExtra("dob", bundle.getString("dob"));
                    intent.putExtra("sex", bundle.getString("sex"));
                    intent.putExtra("idx", bundle.getString("idx"));
                    intent.putExtra("Ps", bundle.getString("Ps"));
                    intent.putExtra("fbcode",bundle.getString("fbcode"));
                    startActivity(intent);
                    finish();
//				dialog.dismiss();
                    Flt.interrupt();

                }
            }
        };
    }
    public boolean isNetworkStat(final Context context) {//네트워크 연결 체크
        ConnectivityManager manager =
                (ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo mobile = manager.getNetworkInfo(ConnectivityManager.TYPE_MOBILE);
        NetworkInfo wifi = manager.getNetworkInfo(ConnectivityManager.TYPE_WIFI);
        NetworkInfo lte_4g = manager.getNetworkInfo(ConnectivityManager.TYPE_WIMAX);
        boolean blte_4g = false;
        if(lte_4g != null)
            blte_4g = lte_4g.isConnected();
        if( mobile != null ) {
            if (mobile.isConnected() || wifi.isConnected() || blte_4g)

                return true;
        } else {
            if ( wifi.isConnected() || blte_4g )

                return true;
        }

        AlertDialog.Builder dlg = new AlertDialog.Builder(context);
        dlg.setTitle("네트워크 오류");
        dlg.setMessage("네트워크 상태를 확인해 주십시요.");

        dlg.setNegativeButton("확인", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
                dialog.dismiss();
                finish();

            }
        });
        dlg.show();
        return false;
    }
}

