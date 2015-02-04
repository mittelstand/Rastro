package com.example.rastro;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import java.util.ArrayList;

import Adapter.*;
import Thread.prizeupdate_deleteThread;
/**
 * Created by 아연이 on 2015-01-26.
 */
public class Prizedetail extends Activity{
    Intent intent;
    int Position;
    String pname,pinst,pdetail,i,idx,name;
    prizeupdate_deleteThread PUDT;
    final  static int modiy=0;
    final static  int Delete=1;
    EditText Pname,Pinst,Pdetail;
    MyListAdapter adapter;
    ArrayList<license> license;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.prizedetail);

        intent = getIntent();
        pname = intent.getStringExtra("pName");
        pinst = intent.getStringExtra("pinst");
        pdetail = intent.getStringExtra("pd");
        Position = intent.getExtras().getInt("position");//이전 액티비티에 있는 리스트뷰 인덱스값
        i = intent.getStringExtra("i");
        idx = intent.getStringExtra("idx");
        name = intent.getStringExtra("name");
        license = new ArrayList<license>();
        getActionBar().setTitle("상세 보기");
        getActionBar().setDisplayHomeAsUpEnabled(true);
        getActionBar().setHomeButtonEnabled(true);
        Pname = (EditText)findViewById(R.id.EditpName);
        Pinst=(EditText)findViewById(R.id.Editpinst);
        Pdetail = (EditText)findViewById(R.id.EditpDetail);

        Pname.setText(pname);
        Pinst.setText(pinst);
        Pdetail.setText(pdetail);

    }
    public void mPopup(View v){
        switch (v.getId()){
            case R.id.modify:
                PUDT = new prizeupdate_deleteThread(Pname.getText().toString(),Pinst.getText().toString(),Pdetail.getText().toString(),name,i,mHandler,idx,"modify");
                PUDT.start();//수정일때 쓰레드
                   break;
            case R.id.Delete:
                PUDT = new prizeupdate_deleteThread(Pname.getText().toString(),Pinst.getText().toString(),Pdetail.getText().toString(),name,i,mHandler,idx,"del");
                PUDT.start();//삭제일때 쓰레드
        }

    }
    Handler mHandler = new Handler(){
        public void handleMessage(Message msg){
        if(msg.what==3){//수정이 되었을때
           Intent intent = new Intent();
            intent.putExtra("Pname",Pname.getText().toString());
            intent.putExtra("Pinst",Pinst.getText().toString());
            intent.putExtra("Pdetail",Pdetail.getText().toString());
            intent.putExtra("position",Position);
            intent.putExtra("i",i);
            setResult(modiy, intent);
            PUDT.interrupt();
            Toast.makeText(Prizedetail.this, "수정이 완료 되었습니다.", Toast.LENGTH_SHORT).show();

        }
        if(msg.what==2){//삭제가 되었을때

            Intent intent = new Intent();
            intent.putExtra("position",Position);
            intent.putExtra("i",i);
            setResult(Delete, intent);
            PUDT.interrupt();
            finish();
            Toast.makeText(Prizedetail.this, "삭제 되었습니다.", Toast.LENGTH_SHORT).show();
        }

        }

    };
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // TODO Auto-generated method stub

        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                break;
//		case R.id.menu_search:
//
//			break;

        }
        return false;

    }
}
