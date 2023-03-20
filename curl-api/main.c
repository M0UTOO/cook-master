/*
PURPOSE: TRYING OUT THE CURL FUNCTIONS FROM A C PROGRAM
FROM THE NOU DEV TEAM

TO COMPILE : gcc main.c -o main.exe -lcurl
*/

#include <stdio.h>
#include <curl/curl.h>

int main(int argc, char ** argv){

    CURL *curl;

    printf("OK");

    curl = curl_easy_init();

    curl_easy_cleanup(curl);
    return 0;

}