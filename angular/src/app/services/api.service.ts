import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { map, catchError } from 'rxjs/operators';
import { throwError, Observable } from 'rxjs';

export interface IFormattedError {
  status: number;
  errorMessage: string;
}

export interface IAPIResponse { 
  data: any, 
  status: number 
}

@Injectable({
  providedIn: 'root'
})
export class APIService {
  readonly hostURL: string = 'http://127.0.0.1:8080/';
  private requestOptions;

  constructor(
    private http: HttpClient,
  ) {
    this.setHeader();
  }

  setHeader() {
    let requestHeaders = new HttpHeaders();
    requestHeaders = requestHeaders.set('Content-Type', 'application/json');

    this.requestOptions = {
      headers: requestHeaders,
      observe: 'response'
    };
  }

  get(route: string): Promise<IAPIResponse | IFormattedError> {
    const apiRoute = this.hostURL + route;
    const returnable = this.http.get(apiRoute, this.requestOptions)
      .pipe(
        map(response => this.formatResponse(response)),
        catchError((error: any) => this.handleError(error))
      )
      .toPromise();
    return returnable;
  }

  handleError(error): Observable<IFormattedError> {
    const formattedError: IFormattedError = <IFormattedError>{
      status: null,
      errorMessage: ''
    };
    //Validate
    if (error) {
      //Update Status
      if (error.status !== undefined) {
        formattedError.status = error.status;
      }

      // error message
      if (error.statusText) {
        formattedError.errorMessage = error.statusText
      }
    }
    return throwError(formattedError);
  }

  formatResponse(response: any): IAPIResponse {
    let formattedResponse: IAPIResponse = {
      data: null,
      status: 0
    };

    if (response) {
      if (response.body) {
        formattedResponse.data = response.body;
      }
      if (response.status) {
        formattedResponse.status = response.status;
      }
    }
    return formattedResponse;
  }
}
