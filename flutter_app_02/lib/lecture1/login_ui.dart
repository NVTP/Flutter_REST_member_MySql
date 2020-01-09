import 'package:flutter/material.dart';

//TODO class แรกไว้รับค่า
class LoginUI extends StatefulWidget {
  @override
  _LoginUIState createState() => _LoginUIState();
}

//TODO ไว้เกี่ยวกับหน้าจอ
class _LoginUIState extends State<LoginUI> {
  TextEditingController memUsername = TextEditingController();
  TextEditingController memPassword = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.deepOrange,
        title: Text(
          'LOGIN',
        ),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        child: Center(
          child: Column(
            children: <Widget>[
              Icon(
                Icons.accessibility,
                color: Color(0xFF588946),
                size: 250.0,
              ),
              Padding(
                padding: const EdgeInsets.only(
                  left: 48.0,
                  right: 48.0
                ),
                child: TextFormField(
                  controller: memUsername,
                  decoration: InputDecoration(
                    prefixIcon: Icon(
                      Icons.person,
                      color: Colors.deepOrange,
                    ),
                    hintText: 'UserName',
                  ),
                ),
              ),
              SizedBox(
                height: 12.0,
              ),
              Padding(
                padding: const EdgeInsets.only(
                    left: 48.0,
                    right: 48.0
                ),
                child: TextFormField(
                  controller: memPassword,
                  decoration: InputDecoration(
                    prefixIcon: Icon(
                      Icons.lock,
                      color: Colors.deepOrange,
                    ),
                    hintText: 'Password',
                    suffixIcon: Icon(
                      Icons.visibility_off,
                    ),
                  ),
                ),
              ),
              SizedBox(
                height: 24.0,
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  RaisedButton(
                    onPressed: (){
//                      print(memUsername.text);
//                      print(memPassword.text);
                    //TODO ส่ง Username , Password ไปที่ Server เพื่อตรวจสอบ
                    },
                    child: Text(
                      'Login',
                      style: TextStyle(
                        color: Colors.white
                      ),
                    ),
                    color: Colors.deepOrange,
                  ),
                  SizedBox(width: 16.0,),
                  RaisedButton(
                    onPressed: (){
                      memUsername.clear();
                      memPassword.clear();
                    },
                    child: Text(
                      'Cancel',
                      style: TextStyle(
                          color: Colors.white
                      ),
                    ),
                    color: Colors.deepOrange,
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
