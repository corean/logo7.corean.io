Tabler 관련 링크
* [Introduction](https://preview.tabler.io/docs/)
* [Form elements](https://preview.tabler.io/form-elements.html)
* [Icons](https://preview.tabler.io/icons.html)

## 작업 이력
- 2022-12-25 table 레이아웃 적용
- 2022-12-26 아이콘 폰트 적용해봤으나, 두께 조절은 svg만 가능해서 다시 원복
- 2022-12-27 nav 메뉴 hover 효과 적용. 다크모드. 
- 2022-12-28 toast, notify, alert 적용해봤으나, alert로 확정
- 2022-12-29 연간회원 동작 (입금처, 삭제, 입금처리 취소)
- 2022-12-30 연간회원 상세, 수정 
- 2023-01-04 연간회원 다담그
- 2023-01-15 laravel sail 적용 (docker-compose) / 이메일 발송 테스트 
- 2023-01-18 inertia 1.0 업데이트 (Modal 업데이트는 아직도..)
- 2023-01-19 로그인 방식 변경 (Member > User)
- 2023-01-25 envoy 배포 & 비밀번호 재설정 기능 추가 
- 2023-01-26 breadcrumb 적용 & telescope 설치
- 2023-01-27 비밀번호 찾기시 Member 모델도 적용
- 2023-01-29 파일 미리보기 적용
- 2023-02-03 breadcrumbs 관련 오류 수정, 이전 작업에서 모델관련 내용 적용 
- 


## To-Do
- [x] primary color 변경
- [x] 다크모드
- [x] toastr 적용
- [x] 연간회원 페이지 
- [x] 회원가입 프로세스 확인
- [x] 비밀번호 찾기 기능 확인
- [x] toastr 적용
- [ ] ~~github action 을 이용한 CI/CD 구성~~
- [x] envoy 배포
- [x] breadcrumb 적용
- [x] telescope 설치
- [x] 권한 처리
- [x] 메일 발송 테스트 (SPF)
- [x] 서버 이름 변경 : corean.biz > corean.io (logo@corean.biz 발송시 /var/spool/mail로 빠짐)
- [x] 비밀번호 찾기후 변경시 Member 모델도 적용
- [ ] Nav 메뉴 구조화
- [ ] 테스트 코드 작성


deploy
```bash
php vendor/bin/envoy run deploy
```
- nginx > symbolick 링크 관련 오류 : https://github.com/zendtech/ZendOptimizerPlus/issues/126
