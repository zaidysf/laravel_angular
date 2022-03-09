import { Student } from './student.model';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';


@Injectable()
export class StudentService {

  public apiUrl: string = "/api/";
  _http: HttpClient;

  constructor(http: HttpClient) {
    this._http = http;
  }

  getAllStudents(): Observable<Student[]> {
    return this._http.get<Student[]>(`${this.apiUrl}students`, {headers: new HttpHeaders({
      'Authorization': 'Bearer' + localStorage.getItem('token'),
      'Content-Type': 'application/json'
    })})
  }

  createStudent(student: Student): Observable<Student> {
    return this._http.post<Student>(`${this.apiUrl}students`, student, {headers: new HttpHeaders({
      'Authorization': 'Bearer' + localStorage.getItem('token'),
      'Content-Type': 'application/json'
    })});
  }

  deleteStudent(studentId: number): Observable<any> {
    return this._http.delete(`${this.apiUrl}students` + studentId, {headers: new HttpHeaders({
      'Authorization': 'Bearer' + localStorage.getItem('token'),
      'Content-Type': 'application/json'
    })});
  }

  updateStudent(studentId: string | number, changes: Partial<Student>): Observable<any> {
    return this._http.put(`${this.apiUrl}students` + studentId, changes, {headers: new HttpHeaders({
      'Authorization': 'Bearer' + localStorage.getItem('token'),
      'Content-Type': 'application/json'
    })});
  }
}

