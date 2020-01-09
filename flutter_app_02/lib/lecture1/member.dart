class Member {
  String message;
  String memId;
  String memName;
  String memUsername;
  String memPassword;
  String memStatus;

  Member(
      {this.message,
        this.memId,
        this.memName,
        this.memUsername,
        this.memPassword,
        this.memStatus});

  Member.fromJson(Map<String, dynamic> json) {
    message = json['message'];
    memId = json['memId'];
    memName = json['memName'];
    memUsername = json['memUsername'];
    memPassword = json['memPassword'];
    memStatus = json['memStatus'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['message'] = this.message;
    data['memId'] = this.memId;
    data['memName'] = this.memName;
    data['memUsername'] = this.memUsername;
    data['memPassword'] = this.memPassword;
    data['memStatus'] = this.memStatus;
    return data;
  }
}
