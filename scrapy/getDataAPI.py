import requests
import json
response = requests.get("http://127.0.0.1:8000/api/comic?all=true")
# print(response.json())

json_response = response.json()
# dictionary = json.dumps(response.json(), sort_keys = True, indent = 4)
# print(dictionary)

json_response = json_response['data']
for item in json_response:
    response_comic = requests.get("http://127.0.0.1:8000/api/result?id_comic=" + str(item['id']))
    json_response_comic = response_comic.json()
    json_response_comic = json_response_comic['data']['results']
    
    print( item['name'])
    for result in json_response_comic:
        print('http://'+result['web']['url']+result['short_url'])
        print(result['web']['xpath_chapter'])


    