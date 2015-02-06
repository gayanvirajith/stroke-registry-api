# Stroke registry api


### Login Request

curl -i -H "Content-type: application/json" -c cookies.txt \
  -XPOST "http://localhost:8000/login" \
  -d '{"username": "user", "password": "user"}'


### Logout request

curl -i -H "Content-type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/logout"


### Generate patient profile

curl -i -H "Content-Type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/patient/generate-profile"