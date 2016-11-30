# PPD TEST

Universal RESTful question-answer tester built with Laravel 5.3. Currently configured for testing knowledge of traffic laws of Republic of Uzbekistan.

## API

### Start exam

| Method  | URL  | Params  |
|:-:|:-:|---|
| POST  | /api/exams  |   |

Request: `POST /api/exams`

Response:
```js
{
  "id": 1,
  "api_token": "V3NrIr4Awo1F12RdVG190ma6doblZfsbYkaV1sQllaV4G9LoVfm4RZiLK74b",
  "total_questions": 10
}
```
* `id` - exam identifier
* `api_token` - session identifier, should be used for rest requests related to this exam
* `total_questions` - total amount of questions in exam

___

### Get question

| Method  | URL  | Params  |
|:-:|:-:|---|
| GET  | /api/exams/`exam_id`/questions/`question`  | <ul><li>`exam_id` - exam id</li><li>`question` - number of question</li><li>`api_token` - `api_token` |

Request: `GET /api/exams/1/questions/1?api_token=...`

Response:
```js
{
  "id": 1,
  "exam_id": 1,
  "number": 1,
  "text": "Lorem ipsum dolor sit amet?",
  "answers": {
    "1": "Lorem.",
    "2": "Lorem ipsum dolor.",
    "3": "Lorem ipsum."
  }
}
```
* `id` - question id (should not be used)
* `exam_id` - exam id
* `number` - number of question
* `text` - text of the question
* `answers` - object, answers to the question

___

### Answer to question

| Method  | URL  | Params  |
|:-:|:-:|---|
| PATCH/PUT  | /api/exams/`exam_id`/questions/`question`  | <ul><li>`exam_id` - exam id</li><li>`question` - number of question</li><li>`answer` - number of answer</li><li>`api_token` - `api_token`</li> |

Request: `PATCH /api/exams/1/questions/1?api_token=...&answer=1`

Response:
```js
{
  ... // same as GET

  "answer": {
    "number": 1,
    "correct": true
  }
}
```
* `answer` - object, contains `number` of chosen answer and a `correct` flag, which indicates that the answer is correct/incorrect
