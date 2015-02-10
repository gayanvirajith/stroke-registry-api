# Stroke Registry API


### Login Request

```
curl -i -H "Content-type: application/json" -c cookies.txt \
  -XPOST "http://localhost:8000/login" \
  -d '{"username": "user", "password": "user"}'
```

### Logout request

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/logout"
```

### Generate patient profile

```
curl -i -H "Content-Type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/patient/generate-profile"
```

### Update patient profile

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XPOST "http://localhost:8000/patient/update-profile/1" \
  -d '
  {
    "name": "Gayan Virajith", 
    "nic": "873322837V", 
    "sex": "M",
    "address_1": "190 / 6 C, Weera Mw, Depanama",
    "address_2": "Pannipitiya",
    "province": 8,
    "dob": "1987-11-27",
    "bht_number": 19,
    "contact_no_1": "94719057970",
    "contact_no_2": "0112837853",
    "guardian_name": "Maheshika Lakmali",
    "guardian_contact_no_1": "94719057971",
    "guardian_contact_no_2": "0112837853",
    "age": "27",
    "pregnant": 0,
    "ethnicity": 1,
    "dexterity": 1,
    "education": 6,
    "employement": 4,
    "level_of_independence": 1,
    "living_arrangement": 1
  }
  '
```

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XPOST "http://localhost:8000/patient/update-profile/2" \
  -d '
  {
    "name": "Maheshika Lakmali", 
    "nic": "885322837V", 
    "sex": "F",
    "address_1": "190 / 6 C, Weera Mw, Depanama",
    "address_2": "Pannipitiya",
    "province": 8,
    "dob": "1988-06-27",
    "bht_number": 10,
    "contact_no_1": "94719057970",
    "contact_no_2": "0112837853",
    "guardian_name": "Gayan Virajith",
    "guardian_contact_no_1": "94719057971",
    "guardian_contact_no_2": "0112837853",
    "age": "26",
    "pregnant": 1,
    "pregnant_status": 4,
    "ethnicity": 1,
    "dexterity": 1,
    "education": 6,
    "employement": 1,
    "level_of_independence": 1,
    "living_arrangement": 1
  }
  '
```


### Show patient event onset

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/patient/event-onset/1"
```

### Update patient event onset

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XPOST "http://localhost:8000/patient/update-event-onset/1" \
  -d '{
    "episode_id": "0",
    "onset_of_stroke_at": "0000-00-00 00:00:00",
    "first_presentation_to": 0,
    "admisson_time": "0000-00-00 00:00:00",
    "onset_to_admission_time": "0.00",
    "transport_mode": 0,
    "stroke_occur_in_hospital": 0,
    "symptoms": "",
    "oxfordshire_classification": 0,
    "side_of_symptoms": 0,
    "modified_rankin_scale": "",
    "barthel_index": "",
    "gcs": "",
  }'
```


### Show patient drug history

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XGET "http://localhost:8000/patient/drug-history/1"
```

### Update patient drug history

```
curl -i -H "Content-type: application/json" -b cookies.txt \
  -XPOST "http://localhost:8000/patient/update-drug-history/1" \
  -d '{
    "use_antiplatelet": 1,
    "use_anticoagulation": 1,
    "antiplatelet_status": 0,
    "anticoagulation_status": 0,
    "thrombolysis_for_stemi": 0,
    "thrombolysis_for_stroke": 0
  }'
  
```