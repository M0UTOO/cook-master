/*
PURPOSE: TRYING OUT THE CURL FUNCTIONS FROM A C PROGRAM
FROM THE NOU DEV TEAM

TO COMPILE : gcc main.c -o main.exe -lcurl
*/

#include <stdio.h>
#include <curl/curl.h>

int main(int argc, char ** argv){

    CURL *curl;
    CURLcode res;
 
  curl = curl_easy_init();
  if(curl) {
    curl_easy_setopt(curl, CURLOPT_URL, "https://google.com");

    /* Perform the request, res will get the return code */
    res = curl_easy_perform(curl);
    /* Check for errors */
    if(res != CURLE_OK)
      fprintf(stderr, "curl_easy_perform() failed: %s\n",
              curl_easy_strerror(res));
 
    /* always cleanup */
    curl_easy_cleanup(curl);
  }
    return 0;

}