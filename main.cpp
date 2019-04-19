#include <algorithm>
#include <iostream>
#include<vector>
#include<stack>
#include <math.h>
#include <map>
#include <string>
#include <queue>
#include <set>
#include <iomanip>
//#include<bits/stdc++.h>
#define ll long long int
#define fli(j,n) for(int i=j;i<n;i++)
#define flj(i,n) for(int j=i;j<n;j++)
using namespace std;



auto fast_io =[]()
{
    std::ios::sync_with_stdio(false);
    cin.tie(nullptr);
    cout.tie(nullptr);
    cout.precision(10);
    return nullptr;
}();
int n,arr[10001],dp[10001];
vector <int> tic[10001];
pair<int solve(int i){
    if(i>n)
        return {0,vector <int>(0)};
    if(dp[i]>-1){
        return {dp[i],tic[i]};
    }
    pair<int, vector<int> > x,y;
    if( arr[i] <= 0 ){
        x=solve(i+1);
        y=solve(i+2);
        if(x.first>y.first){
            dp[i] = x.first;
            tic[i] = tic[i+1];
        }else if(x<y){
            dp[i] = y.first;
            tic[i] = tic[i+1];
        }else{
            dp[i] = x.first;
            int k=-1;
            for(int j=0,k=-1;;j++){
                if(arr[tic[i+1][j]]<arr[tic[i+2][j]]){
                    k = 0;
                    break;
                }else if(arr[tic[i+1][j]]>arr[tic[i+2][j]]){
                    k = 1;
                    break;
                }
            }
            tic[i] = k==-1?tic[i+1]:tic[i+1+k];
        }
    }else{
        x=solve(i+2);
        y=solve(i+3);
        dp[i] = arr[i];
        if(x.first>y.first){
            dp[i] += x.first;
            tic[i] = tic[i+1];
        }else if(x<y){
            dp[i] += y.first;
            tic[i] = tic[i+1];
        }else{
            dp[i] += x.first;
            int k=-1;
            for(int j=0,k=-1;j<tic[i+1].size()&&j<tic[i+2].size();j++){
                if(arr[tic[i+1][j]]<arr[tic[i+2][j]]){
                    k = 0;
                    break;
                }else if(arr[tic[i+1][j]]>arr[tic[i+2][j]]){
                    k = 1;
                    break;
                }
            }
            tic[i] = k==-1?tic[i+1]:tic[i+1+k];
        }
        tic[i].push_back(i);
    }
    return {dp[i],tic[i]};
}
int main()
{
    int t;
    cin>>t;
    while(t--){
        memset(dp,-1,sizeof(dp));
        memset(tic,-1,sizeof(tic));
        flag = 0;
        cin>>n;
        fli(1,n+1){
            cin>>arr[i];
        }
        arr[0] = -1;
        vector <int> s;
        cout<<solve(0)<<endl;
    }
    return 0;
}