# HighCohesion Message Class
A package that provides the structure for the message class which is used to communicate with the various microservices
in the HighCohesion architecture.

### Releasing a new version

1. Run `make checkout`
2. Run `make build`
3. Apply your changes and update the composer VERSION TAG
4. Run `make version`
5. Create a new pr from your release branch into master
