export interface Student {
  id: number;
  name: string;
}

export interface GetStudentResult {
  data: {
    data: Student[]
  }
  message: string
  status: number
}
