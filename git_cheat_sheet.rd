# Cloning repo
git clone url.git

# Make change
git add .
git commit -a
git push

# Create branch
git checkout -b branch_name
git push origin branch_name

# Make first change after branching
git add .
git commit -a
git push -u origin branch_name