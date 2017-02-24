#include<stdio.h>
#include<conio.h>
#include<graphics.h>
#include<stdlib.h>
void main()
{
 clrscr();
 char input;
 int gd=DETECT,gm,err,i=0,j=0,t=0,m=0;
 initgraph(&gd,&gm,"c:\\turboc3\\bgi");
 clrscr();
 setbkcolor(4);
 setcolor(15);
 err=graphresult();
 if(err!=grOk)
 {
  printf("error is %s",grapherrormsg(err));
 }
 //1st man//

 circle(92+i,320,12);
 line(92+i,332,92+i,384);
 line(92+i,384,72+i,400);
 line(92+i,384,112+i,400);
 line(92+i,332,72+i,348);
 line(92+i,332,112+i,348);
 line(0,400,650,400);
 //another man//
 circle(492+j,320,12);
 line(492+j,332,492+j,384);
 line(492+j,384,472+j,400);
 line(492+j,384,512+j,400);
 line(492+j,332,472+j,348);
 line(492+j,332,512+j,348);
 //sword for hand 1
 line(112+i,348,122+i,295);
 //sword for hand 2
 line(472+j,348,462+j,295);
 input=getche();
 while(input=='d'||input=='a'||input=='j'||input=='l'||input=='r'||input||'q'||input=='u'||input=='p')
 {
  if(input=='d')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   i=i+20;
   //moving 1st man towards right
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making stand man at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
    //sword for hand 1
   line(112+i,348,122+i,295);
    //sword for hand 2
   line(472+j,348,462+j,295);
  }
  else if(input=='a')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   i=i-20;
   //moving 1st man towards left
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making 2nd man stand still
   circle(492+j,320,12);
   line(492+j,332,492+j,384);
   line(492+j,384,472+j,400);
   line(492+j,384,512+j,400);
   line(492+j,332,472+j,348);
   line(492+j,332,512+j,348);
   //sword for hand 1
   line(112+i,348,122+i,295);
   //sword for hand 2
   line(472+j,348,462+j,295);
   }
   else if(input=='r')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   //making 1st man stand still
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making 2nd man stand at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
    //sword for head 1
    line(112+i,348,155+i,319);
     //sword for hand 2
    line(472+j,348,462+j,295);
    printf("%d",155+i);
    if(155+i>492+j&&92+i<492+j)
    {
     t++;
     printf("POINTS %d \nman 1=%d \nman 2=%d ",155+i,t,m);
    }
    if(t>5)
     {
      clrscr();
      printf("        \tman 1 wins\t\t man1 wins \t\tman1 wins\t      ");
      break;
     }
   }
   else if(input=='p')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   //moving man stand still
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making stand man at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
    //sword for head 2
    line(472+j,348,429+j,319);
      //sword for hand 1
     line(112+i,348,122+i,295);
     if(429+j<92+i&&92+i<492+j)
     {
      m++;
      printf("POINTS  \nman 1=%d \nman 2=%d ",t,m);
     }
     if(m>5)
     {
      clrscr();
      printf("        \tman 2 wins\t\t man 2 wins \t\tman 2 wins\t      ");
      break;
     }
   }
   else if(input=='q')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   //moving man stand still
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making stand man at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
    //sword for stomach1
    line(112+i,348,170+i,348);
     //sword for hand 2
     line(472+j,348,462+j,295);
     if(170+i>492+j&&92+i<492+j)
    {
     t++;
     printf("POINTS  \nman 1=%d \nman 2=%d ",t,m);
    }
    if(t>5)
     {
      clrscr();
      printf("         \tman 1 wins\t\t man1 wins \t\man 1 wins\t      ");
      break;
     }
   }
   else if(input=='u')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   //moving man stand still
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making stand man at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
    //sword for stomach2
    line(472+j,348,420+j,348);
    //sword for hand 1
    line(112+i,348,122+i,295);
    if(420+j<92+i&&92+i<492+j)
    {
     m++;
     printf("POINTS  \nman 1=%d \nman 2=%d ",t,m);
    }
    if(m>5)
     {
      clrscr();
      printf("         \tman 2 wins\t\t man 2 wins \t\man 2 wins\t      ");
      break;
     }
    }
   else if(input=='l')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   j=j+20;
   //moving 1st man towards right
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //making stand man at its own place
    circle(492+j,320,12);
    line(492+j,332,492+j,384);
    line(492+j,384,472+j,400);
    line(492+j,384,512+j,400);
    line(492+j,332,472+j,348);
    line(492+j,332,512+j,348);
  //sword for hand1
   line(112+i,348,122+i,295);
  //sword for hand 2
   line(472+j,348,462+j,295);
  }
  else if(input=='j')
  {
   clrscr();
   setbkcolor(4);
   setcolor(15);
   j=j-20;
   circle(92+i,320,12);
   line(92+i,332,92+i,384);
   line(92+i,384,72+i,400);
   line(92+i,384,112+i,400);
   line(92+i,332,72+i,348);
   line(92+i,332,112+i,348);
   line(0,400,650,400);
   //moving 2nd man towards left
   circle(492+j,320,12);
   line(492+j,332,492+j,384);
   line(492+j,384,472+j,400);
   line(492+j,384,512+j,400);
   line(492+j,332,472+j,348);
   line(492+j,332,512+j,348);
   //sword for hand
   line(112+i,348,122+i,295);
   //sword for hand 2
   line(472+j,348,462+j,295);
   }
  input=getche();
 }
 getch();
 closegraph();
}