# sf_skeleton
Basic project set up to speed up webpage creation.

## Create new project

Step 1: you need to clone this repository and remove all history first.

```
git clone git@github.com:KaanTolunayKilic/sf_skeleton.git <PROJECT_NAME>
cd <PROJECT_NAME>
rm -rf .git
```

Step 2: reconstruct the Git repository with only the current content

```
git init
git add .
git commit -m "Initial commit"
```

Step 3: push to GitHub

```
git remote add origin <GITHUB_URI>
git push -u --force origin master
```
