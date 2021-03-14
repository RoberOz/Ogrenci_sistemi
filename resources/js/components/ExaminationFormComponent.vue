<template>
  <div>
    <!-- <form method="post" action="{{url('exams/modify-exam-store')}}"> -->
    <form v-on:submit.prevent="submitForm">
      <div class="list-group col" id="examinationQuestions">
        <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestion(examination.id)">Soru Ekle</button>
        <br>
        <draggable ghost-class="ghost" @end="onEnd">
          <transition-group type="transition">
              <div v-for="examinationquestion in examinationquestions" :key="examinationquestion.id">
                <div v-if="examination.id == examinationquestion.examination_id">
                  <div class="list-group-item">
                    <textarea rows="2" cols="80" @change="changeContent(examinationquestion.id,examinationquestion.content,examination.id,$event)" required>{{examinationquestion.content}}</textarea>
                    <button type="button" class="btn btn-primary btn-outline-light" style="background:#B60C09" @click="deleteQuestion(examinationquestion.id)">Soruyu Sil</button>
                    <br>
                    <div v-for="(value, key) in examinationquestion.options">
                      <input type="text" :value="key" @change="changeKey(examinationquestion.id,key,examination.id,$event)" style="width:30px;"></input>:
                      <input type="text" :value="examinationquestion.options[key]" @change="changeValue(examinationquestion.id,key,examination.id,$event)">
                      <button type="button" class="btn btn-primary btn-outline-light btn-sm" style="background:#B60C09" @click="deleteQuestionOption(examinationquestion.id,key)">X</button>
                      <br><br>
                    </div>
                    <button type="button" class="btn btn-primary btn-outline-light" style="width:150px;" @click="addNewQuestionOption(examinationquestion.id)">Şık Ekle</button>
                  </div>
                </div>
              </div>
          </transition-group>
        </draggable>
      </div>
      <br>
      <div align="center">
        <button type="submit" class="btn btn-primary btn-outline-light" style="background:#19A713;">Kaydet</button>
      </div>
    </form>
    <p><strong>Previous Index:</strong> {{oldIndex}} </p>
    <p><strong>New Index:</strong> {{newIndex}} </p>
  </div>
</template>

<script>
import axios from "axios";
import draggable from 'vuedraggable';

    export default {
        props: [
          'examinationquestions',
          'examination'
        ],
        components: {
          draggable,
        },
        data() {
          return {
            oldIndex: "",
            newIndex: "",
            fields: {
              examinationQuestionId:"",
              examinationId:"",
              order:"",
              content: {},
              jsonKey: {},
              jsonValue: {},
            },
          }
        },
        methods:{
          addNewQuestion(id){
            axios.post('/exams/modify-exam-add-question', {
              examinationId: id,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error addNewQuestion failed!');
                 });
          },
          deleteQuestion(id){
            let examinationQuestionId = id;
            console.log(examinationQuestionId);
            axios.delete('/exams/modify-exam/'+examinationQuestionId)
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error deleteQuestion failed!');
                 });
          },
          addNewQuestionOption(id){
            axios.post('/exams/modify-exam-add-question-option', {
              examinationQuestionId: id,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error addNewQuestionOption failed!');
                 });
          },
          deleteQuestionOption(id,key){
            axios.post('/exams/modify-exam-delete-question-option', {
              examinationQuestionId: id,
              jsonKey: key,
            })
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error deleteQuestion failed!');
                 });
          },
          submitForm(){
            axios.post('/exams/modify-exam-store',this.fields)
                 .then((response) => {
                   location.reload();
                 })
                 .catch((error) => {
                   console.log('Error submitForm failed!');
                 });
          },
          onEnd: function(evt) {
            console.log(evt);
            this.oldIndex = evt.oldIndex;
            this.newIndex = evt.newIndex;
          },
          changeContent: function(examinationQuestionId,content,examinationId,eventContent) {
            console.log(eventContent);
            this.fields.content[examinationQuestionId] = event.target.value;
            this.fields.examinationQuestionId = examinationQuestionId;
            this.fields.examinationId = examinationId;
          },
          changeKey: function(examinationQuestionId,key,examinationId,eventKey) {
            console.log(eventKey);
            this.fields.jsonKey[examinationQuestionId] = event.target.value;
            this.fields.examinationQuestionId = examinationQuestionId;
            this.fields.examinationId = examinationId;
          },
          changeValue: function(examinationQuestionId,key,examinationId,eventValue) {
            console.log(eventValue);
            this.fields.jsonValue[examinationQuestionId] = event.target.value;
            this.fields.examinationQuestionId = examinationQuestionId;
            this.fields.examinationId = examinationId;
          },
        },
        mounted() {
            console.log('Examination Form Component Mounted.');
        }
    }
</script>

<style>
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
  border-left: 6px solid rgb(0,183,255);
}
</style>
