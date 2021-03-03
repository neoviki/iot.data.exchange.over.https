import requests

#both http and https works well
LOGIN_URL = "http://yourserver.com/login.php"
DB_PUSH_URL = "http://yourserver.com/db_push.php"


def push_vehicle_data(username, password, vehicle_id, speed, lat, lon):
    login_payload = {'username': username, 'password': password, 'api_login': '1'}
    db_payload = {'api_db_push': '1', 'vehicle_id': vehicle_id, 'time_sent': '2021-03-10 20:54:17.000002',
                    'gps_lat': lat, 'gps_lon': lon, 'speed': speed}
    with requests.Session() as session:
        post = session.post(LOGIN_URL, data=login_payload)
        if(post.status_code != 200):
            print("credential error")
            return -1

        post = session.post(DB_PUSH_URL, data=db_payload)

        if (post.status_code != 200):
            print("db error")
            return -1

        print("vehicle data pushed successfully")
        return 0

#push_vehicle_data('test', 'test123', "BE123", 20.0, 60.00, 70.00)
