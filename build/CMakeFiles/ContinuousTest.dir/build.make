# CMAKE generated file: DO NOT EDIT!
# Generated by "Unix Makefiles" Generator, CMake Version 3.17

# Delete rule output on recipe failure.
.DELETE_ON_ERROR:


#=============================================================================
# Special targets provided by cmake.

# Disable implicit rules so canonical targets will work.
.SUFFIXES:


# Disable VCS-based implicit rules.
% : %,v


# Disable VCS-based implicit rules.
% : RCS/%


# Disable VCS-based implicit rules.
% : RCS/%,v


# Disable VCS-based implicit rules.
% : SCCS/s.%


# Disable VCS-based implicit rules.
% : s.%


.SUFFIXES: .hpux_make_needs_suffix_list


# Suppress display of executed commands.
$(VERBOSE).SILENT:


# A target that is always out of date.
cmake_force:

.PHONY : cmake_force

#=============================================================================
# Set environment variables for the build.

# The shell in which to execute make rules.
SHELL = /bin/sh

# The CMake executable.
CMAKE_COMMAND = /snap/cmake/301/bin/cmake

# The command to remove a file.
RM = /snap/cmake/301/bin/cmake -E rm -f

# Escaping for special characters.
EQUALS = =

# The top-level source directory on which CMake was run.
CMAKE_SOURCE_DIR = "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW"

# The top-level build directory on which CMake was run.
CMAKE_BINARY_DIR = "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build"

# Utility rule file for ContinuousTest.

# Include the progress variables for this target.
include CMakeFiles/ContinuousTest.dir/progress.make

CMakeFiles/ContinuousTest:
	/snap/cmake/301/bin/ctest -D ContinuousTest

ContinuousTest: CMakeFiles/ContinuousTest
ContinuousTest: CMakeFiles/ContinuousTest.dir/build.make

.PHONY : ContinuousTest

# Rule to build all files generated by this target.
CMakeFiles/ContinuousTest.dir/build: ContinuousTest

.PHONY : CMakeFiles/ContinuousTest.dir/build

CMakeFiles/ContinuousTest.dir/clean:
	$(CMAKE_COMMAND) -P CMakeFiles/ContinuousTest.dir/cmake_clean.cmake
.PHONY : CMakeFiles/ContinuousTest.dir/clean

CMakeFiles/ContinuousTest.dir/depend:
	cd "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" && $(CMAKE_COMMAND) -E cmake_depends "Unix Makefiles" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build" "/home/peterbrown/Scrivania/UNI/TERZO ANNO/Linguaggi e tecnologie per il web/ProgettoLTW/build/CMakeFiles/ContinuousTest.dir/DependInfo.cmake" --color=$(COLOR)
.PHONY : CMakeFiles/ContinuousTest.dir/depend

