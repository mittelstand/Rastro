package com.example.rastro;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.view.Window;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

import Adapter.MyListAdapter;
import Adapter.license;
import Thread.prizeupdate_deleteThread;


/**
 * Created by 아연이 on 2015-01-23.
 */
public class prizePopup extends Activity{
    Intent intent;
    int Position;
    ListView list;
    ArrayList<license> license;
    String pname,pinst,pdetail,i,idx,name;
    prizeupdate_deleteThread PUDT;
    EditText Pname,Pinst,Pdetail;
    MyListAdapter adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.prizepopup);
        license = new ArrayList<license>();
        intent = getIntent();
        pname = intent.getStringExtra("pName");
        pinst = intent.getStringExtra("pinst");
        pdetail = intent.getStringExtra("pd");
        Position = intent.getExtras().getInt("position");
        i = intent.getStringExtra("i");
        idx = intent.getStringExtra("idx");
        name = intent.getStringExtra("name");
        list = (ListView)findViewById(R.id.list);


       Pname = (EditText)findViewById(R.id.EditpName);
       Pinst = (EditText)findViewById(R.id.Editpinst);
       Pdetail = (EditText)findViewById(R.id.EditpDetail);

      Pname.setText(pname);
      Pinst.setText(pinst);
      Pdetail.setText(pdetail);


    }
    public void mPopup(View v){
        switch (v.getId()){
            case R.id.modify:
                PUDT = new prizeupdate_deleteThread(Pname.getText().toString(),Pinst.getText().toString(),Pdetail.getText().toString(),name,i,mHandler,idx,"modify");
                PUDT.start();
                System.out.println(Pname.getText().toString());


//									list.setAdapter(adapter);
//									license.remove(position);
//									list.clearChoices();
                break;
            case R.id.Delete:

                break;

        }
    }
    Handler mHandler = new Handler(){
        public void handleMessage(Message msg){
        if(msg.what==3){
            System.out.println(Pname.getText().toString());
            System.out.println(Pinst.getText().toString());
            Toast.makeText(prizePopup.this,"수정이 완료 되었습니다.",Toast.LENGTH_SHORT).show();

        }

        }

    };
}
